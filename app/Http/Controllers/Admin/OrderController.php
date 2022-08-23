<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Http\Controllers\Controller;
use App\Model\CartDetail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Model\status_bayar;
use App\Model\status_kirim;
use App\Model\cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class OrderController extends Controller
{
    public function index()
    {
        $product = Product::get();

        $cart = Order::where('status_cart', 'checkout')->count();
        // $detail = CartDetail::where('product_id', $product->category_id = '1')->count();
        $tshirt = Product::where('category_id', '1')->count();

        $sum = product::where('is_ready', '1')->sum('harga');


        $order = Order::where('status_cart', 'checkout');
        // $jml = order::where('status_bayar_id', '2');
        // $total = Cart::where('etd', '=', $jml)->sum('total');

        $jumlah_data = order::where('status_bayar_id', '2')->count();
        $status_bayar = status_bayar::all();
        $status_kirim = status_kirim::all();

        $order = order::paginate(10);
        return view('admin.order.order', [
            'order' => $order, 'status_bayar' => $status_bayar,
            'status_kirim' => $status_kirim, 'jumlah_data' => $jumlah_data, 'cart' => $cart, 'sum' => $sum,
            'tshirt' => $tshirt
        ]);
    }
    public function pembayaran()
    {
        $order = order::where('status_kirim_id', '0')->get();
        // $order = order::get();
        $status_bayar = status_bayar::all();
        $status_kirim = status_kirim::all();
        return view('admin.order.pembayaran', [
            'order' => $order, 'status_bayar' => $status_bayar,
            'status_kirim' => $status_kirim
        ]);
    }
    public function pengemasan()
    {
        $order = order::where('status_kirim_id', '1')->get();
        // $order = order::get();
        $status_bayar = status_bayar::all();
        $status_kirim = status_kirim::all();
        return view('admin.order.pengemasan', [
            'order' => $order, 'status_bayar' => $status_bayar,
            'status_kirim' => $status_kirim
        ]);
    }
    public function pengiriman()
    {
        $order = order::where('status_kirim_id', '2')->get();
        // $order = order::get();
        $status_bayar = status_bayar::all();
        $status_kirim = status_kirim::all();
        return view('admin.order.pengemasan', [
            'order' => $order, 'status_bayar' => $status_bayar,
            'status_kirim' => $status_kirim
        ]);
    }
    public function selesai()
    {
        $order = order::where('status_kirim_id', '3')->get();
        // $order = order::get();
        $status_bayar = status_bayar::all();
        $status_kirim = status_kirim::all();
        return view('admin.order.selesai', [
            'order' => $order, 'status_bayar' => $status_bayar,
            'status_kirim' => $status_kirim
        ]);
    }
    public function detail($id)
    {
        if ($order = Order::find($id)) {
            if ($order) {
                $cart = Cart::where('user_id', Auth::user()->id)->where('status_cart', 'checkout')->first();
            };
        };
        return view('admin.order.detail', [
            'order' => $order,
            'cart' => $cart
        ]);
    }
    public function cetak_pdf()
    {

        $order = order::where('status_bayar_id', '2')->paginate();
        $pdf = PDF::loadview('admin.order.order_pdf', ['order' => $order]);
        return $pdf->download('laporan_pesanan.pdf');
    }

    public function edit($id)
    {
        $status_bayar = status_bayar::all();
        $status_kirim = status_kirim::all();
        $order = Order::find($id);
        return response()->json([
            'status' => 200,
            'order' => $order,
            'status_bayar' => $status_bayar,
            'status_kirim' => $status_kirim,
        ]);
    }

    public function update(Request $request)
    {
        $date = Carbon::now();
        DB::table('orders')->where('id', $request->id)->update([
            'id' => $request->id,
            'status_bayar_id' => $request->status_bayar_id,
            'status_kirim_id' => $request->status_kirim_id,
            'no_resi' => $request->no_resi,
        ]);
        return back();
    }
}
