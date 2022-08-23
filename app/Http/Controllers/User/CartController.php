<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Models\Product;
use App\models\order;
use App\Model\CartDetail;
use App\Model\Wishlist;
use Illuminate\Support\Facades\DB;
use App\Model\AlamatPengiriman;
use Alert;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
        ]);
        $itemuser = $request->user();
        $product = Product::findOrFail($request->product_id);
        // cek dulu apakah sudah ada shopping cart untuk user yang sedang login

        // if ($request->qty > $product->stok) {
        //     return back()->with('error', 'Pesanan melebihi stok');
        // }

        $cart = Cart::where('user_id', $itemuser->id)
            ->where('status_cart', 'cart')
            ->first();

        if ($cart) {
            $itemcart = $cart;
        } else {

            //nyari jumlah cart berdasarkan user yang sedang login untuk dibuat no invoice
            $inputancart['user_id'] = $itemuser->id;
            $inputancart['status_cart'] = 'cart';
            $itemcart = Cart::create($inputancart);
        }
        // cek dulu apakah sudah ada product di shopping cart
        $cekdetail = CartDetail::where('cart_id', $itemcart->id)
            ->where('product_id', $product->id)
            ->first();
        $qty = 1; // diisi 1, karena kita set ordernya 1
        $harga = $product->harga; //ambil harga product
        $promo = $product->promo;
        $diskon = $promo * $harga;
        $subtotal =  $harga - $diskon;
        $status = 'cart';
        // diskon diambil kalo product itu ada promo, cek materi sebelumnya
        if ($cekdetail) {
            // update detail di table cart_detail
            // $cekdetail->updatedetail($cekdetail, $qty, $harga, $diskon);
            // update subtotal dan total di table cart
            //$cekdetail->cart->updatetotal($cekdetail->cart, $subtotal);
        } else {
            $inputan = $request->all();
            $inputan['cart_id'] = $itemcart->id;
            $inputan['product_id'] = $product->id;
            $inputan['qty'] = 1;
            $inputan['harga'] = $product->harga;
            $inputan['diskon'] = $product->promo * $product->harga;
            $inputan['subtotal'] = $subtotal;
            $itemdetail = CartDetail::create($inputan);
            // update subtotal dan total di table 
            $itemdetail->status_cart = 'cart';
            $product->keranjang = '1';
            $itemdetail->update();
            $product->update();
        }
        return back();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $itemdetail = CartDetail::findOrFail($id);
        $param = $request->param;

        if ($param == 'tambah') {

            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, $qty, $itemdetail->harga, $itemdetail->diskon);
            // update total cart
            // $itemdetail->cart->updatetotal($itemdetail->cart, ($itemdetail->harga - $itemdetail->diskon));
            return back();
        }
        if ($param == 'kurang') {
            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, '-' . $qty, $itemdetail->harga, $itemdetail->diskon);
            // update total cart
            //  $itemdetail->cart->updatetotal($itemdetail->cart, '-' . ($itemdetail->harga - $itemdetail->diskon));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function hapus($id)
    // {
    //     $itemdetail = CartDetail::findOrFail($id);
    //     $product = Product::findOrFail('id', $itemdetail->product_id);
    //     $product->berat = '0';
    //     $product->update();
    //     // update total cart dulu
    //     $itemdetail->delete();
    //     return response()->json([
    //         'success' => 'Record deleted successfully!'
    //     ]);
    // }
    public function deletefromcart(Request $request)
    {
        if (Auth::user()) {
            $id = $request->id;

            if ($cart = Cart::where('user_id', Auth::user()->id)->where('status_cart', 'cart')->first()) {
                $checkout = CartDetail::where('cart_id', $cart->id)
                    ->where('id', $id)->first();

                $product = Product::where('id', $checkout->product_id)->first();
                $product->keranjang = '0';
                $product->update();
                $cart->subtotal = '0';
                $cart->update();

                $checkout->delete();
                return back()->with('success', 'Item berhasil dihapus');
                //return redirect()->back();
            }
        }
    }


    public function kosongkan($id)
    {
        $itemcart = Cart::findOrFail($id);
        $itemcart->detail()->delete(); //hapus semua item di cart detail
        $itemcart->subtotal = '0';
        $itemcart->update();
        return back()->with('success', 'Cart berhasil dikosongkan');
    }

    public function changeStat(Request $request)
    {

        $user = CartDetail::find($request->detail_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function karepmu(Request $request)
    {
        $p = CartDetail::whereIn('id', $request->status)->sum(DB::raw('harga * qty'));

        return response()->json(['success' => $p]);
    }


    public function checkout(Request $request)
    {

        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('status_cart', 'cart')->first();

        if ($cart) {
            $checkout = CartDetail::where('status', '1')
                ->where('cart_id', $cart->id)
                ->get();
        };
        // dd($checkout);
        // $cart->total = $cart->subtotal;
        // $cart->update();
        $alamat = AlamatPengiriman::where('user_id', Auth::user()->id)
            ->where('status', 'utama')
            ->first();
        //dd($checkout);
        //dd($p);
        return view('livewire.checkout', ['detailcart' => $checkout, 'cart' => $cart,  'itemalamatpengiriman' => $alamat])->with('no', 1);
        //print_r($checkout);
    }
    public function updatecart(Request $request)
    {
        $product_id = $request->product_id;
        $qty = $request['qty'];
        $subtotal = $request->subtotal;

        if (Auth::user()) {
            if ($cart = Cart::where('user_id', Auth::user()->id)->where('status_cart', 'cart')->first()) {
                $checkout = CartDetail::where('cart_id', $cart->id)->get();

                $checkout->subtotal = $subtotal;
                $checkout->qty = $qty;
                // //dd($subtotal);
                $checkout->update();
                return redirect()->back();
            }
        }
        // $checkout->update([
        //     'subtotal' => $subtotal,
        //     'qty' => $qty,

        // ]);
    }
    public function updatetotal(Request $request)
    {
        //$total = $request->input('total');
        $subtotal = $request->subtotal;
        if (Auth::user()) {
            $cart = Cart::where('user_id', Auth::user()->id)
                ->where('status_cart', 'cart')->first();

            $cart->subtotal = $subtotal;


            $cart->update();
            return redirect()->back();
        }
    }
}
