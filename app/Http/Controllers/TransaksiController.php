<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Model\CartDetail;
use App\Model\Wishlist;
use App\Model\AlamatPengiriman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            $itemuser = $request->user();
            $itemorder = Order::where('user_id', $itemuser->id)
                ->first();
            $data = array(
                'title' => 'Data Transaksi',
                'itemorder' => $itemorder,
                'itemuser' => $itemuser
            );
            return view('transaksi.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
        } else {
            return abort('403');
        }
    }

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
        $itemuser = $request->user();

        $itemcart = Cart::where('user_id', $itemuser->id)
            ->where('status_cart', 'cart')
            ->first();
        if ($itemcart) {
            $cartdetail = CartDetail::where('cart_id', $itemcart->id)
                ->where('status', '1');
            $checkout = CartDetail::where('cart_id', $itemcart->id)->first();
            $itemalamatpengiriman = AlamatPengiriman::where('user_id', $itemuser->id)
                ->where('status', 'utama')
                ->first();


            //nyari jumlah cart berdasarkan user yang sedang login untuk dibuat no invoice

            if ($itemalamatpengiriman) {
                // buat variabel inputan order
                $no_inv = Cart::where('user_id', $itemuser->id)->count();
                $inputanorder['user_id'] = $itemuser->id;
                $inputanorder['no_inv'] = 'INV390SS ' . str_pad(($no_inv + 381), '5', '0', STR_PAD_LEFT);
                $inputanorder['cart_id'] = $itemcart->id;
                $inputanorder['total'] = $itemcart->total;
                $inputanorder['subtotal'] = $itemcart->subtotal;
                $inputanorder['ongkir'] = $itemcart->ongkir;
                $inputanorder['jasa'] = $itemcart->jasa;
                $inputanorder['total_item'] = CartDetail::where('cart_id', $itemcart->id)->where('status', '1')->sum('qty');
                $inputanorder['status_cart'] = 'checkout';
                $inputanorder['nama_penerima'] = $itemalamatpengiriman->nama_penerima;
                $inputanorder['no_tlp'] = $itemalamatpengiriman->no_tlp;
                $inputanorder['alamat'] = $itemalamatpengiriman->alamat;
                $inputanorder['provinsi'] = $itemalamatpengiriman->province->name;
                $inputanorder['kota'] = $itemalamatpengiriman->city->name;
                $inputanorder['kecamatan'] = $itemalamatpengiriman->kecamatan;
                $inputanorder['kelurahan'] = $itemalamatpengiriman->kelurahan;
                $inputanorder['kodepos'] = $itemalamatpengiriman->kodepos;
                //dd($inputanorder);
                $itemorder = Order::create($inputanorder); //simpan order
                // update status cart
                $itemcart->update(['status_cart' => 'checkout']);

                $product = Product::where('id', $checkout->product_id)->first();
                $product->keranjang = '0';
                $product->update();




                return redirect()->route('transaksi')->with('success', 'Order berhasil disimpan');
            } else {
                return back()->with('error', 'Alamat pengiriman belum diisi');
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $itemuser = $request->user();
        if ($itemuser->role == 'admin') {
            $itemorder = Order::findOrFail($id);
            $data = array(
                'title' => 'Detail Transaksi',
                'itemorder' => $itemorder
            );
            return view('transaksi.show', $data)->with('no', 1);
        } else {
            $itemorder = Order::where('id', $id)
                ->whereHas('cart', function ($q) use ($itemuser) {
                    $q->where('user_id', $itemuser->id);
                })->first();
            if ($itemorder) {
                $data = array(
                    'title' => 'Detail Transaksi',
                    'itemorder' => $itemorder
                );
                return view('transaksi.show', $data)->with('no', 1);
            } else {
                return abort('404');
            }
        }
    }
    public function edit(Request $request, $id)
    {

        $order = order::find($id);
        return view('livewire.edit', ['order' => $order]);
    }

    public function edit_process(Request $order)
    {
        $id = $order->id;

        order::where('id', $id)
            ->update(['status_kirim_id' => 3]);
        return redirect('/transaksi');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function update(Request $request, $id)
    // {

    //     $itemorder = order::find($id);
    //     $this->validate($request, [
    //         'status_cart' => 'required',
    //     ]);
    //     $inputan = $request->all();
    //     $inputan['id'] = $request->id;
    //     $inputan['status_cart'] = $request->status_cart;

    //     $itemorder->cart->update($inputan);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        // update total cart dulu

        $order->delete();

        $order->cart()->delete();

        return back()->with('success', 'Order berhasil dihapus');
    }

    public function changeStatusKirim(Request $request)
    {
        $order = Order::find($request->id);
        $order->status_kirim_id = $request->status_kirim_id;
        $order->save();


        return response()->json(['success' => 'Konfirmasi Pesanan Berhasil']);
    }
}
