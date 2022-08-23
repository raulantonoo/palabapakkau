<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Model\Cart;
use App\Model\CartDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cart = Cart::get();
        // $modals = product::whereMonth('created_at', '=', '04')
        //     ->sum('harga_beli');
        // $max_jual = product::whereMonth('created_at', '=', '02')
        //     ->sum('harga');

        // $modal =  DB::table('products')
        //     ->select(DB::raw('sum(harga_beli * stok) as total'))
        //     ->get();


        $modal = Product::sum(DB::raw('harga_beli * stok'));
        //dd($p);
        //dd($modal);
        $max_jual = product::sum('harga', '*', 'stok');
        $jml_product = product::count();
        $jual = Order::sum('total');
        $untung = $jual - $modal;
        // $jual = cart::whereMonth('date', '=', '04')
        //     ->where('status_kirim_id', '=', '3')
        //     ->sum('subtotal');
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $datas = Order::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $datas = Order::latest()->get();
        }
        $carts = Cart::count();
        $orders = Order::count();
        $detail = CartDetail::sum('qty');
        $total = $carts + $detail;



        return view('admin.laporan.index', [
            'modal' => $modal, 'jual' => $jual, 'max_jual' => $max_jual, 'jml' => $jml_product, 'datas' => $datas, 'total' => $total,
            'cart' => $carts, 'detail' => $detail, 'untung' => $untung
        ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
