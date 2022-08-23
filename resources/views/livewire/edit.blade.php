@extends('layouts_user.app')

@section('content')



<div class="container" style="margin-top:6%">
    <div class="card ">
        <nav pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/transaksi">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Konfirmasi Pesanan</li>
            </ol>
        </nav>
        <div class="col-md-12 m-auto m-1">
            <div class="ml-2 mt-3">
                <b>
                    Detail Transaksi
                </b>
            </div>
            <table class="table table-stripped table-responsive">
                @foreach($order->cart->detail as $detail)
                <tbody>
                    <tr style="border: 1px">
                        <td class="pr-5">
                            {{ $detail->product->nama}}
                        </td>
                        <td>
                            Rp {{number_format(( $detail->product->harga)-($detail->diskon), 2, ',','.') }}
                        </td>
                        <td>
                            x {{ number_format($detail->qty) }}
                        </td>
                        <td class="mr-5 ml-5">
                            Rp {{ number_format($detail->subtotal, 2, ',','.') }}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right">
                            <b> Subtotal</b>
                        </td>
                        <td>
                            Rp {{ number_format( $order->cart->subtotal, 2, ',','.')}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">
                            <b>Ongkos Kirim</b>
                        </td>
                        <td class="text-right ">
                            Rp {{ number_format( $order->cart->ongkir, 2, ',','.')}}
                        </td>
                    </tr>
                    <tr class="bg-warning">
                        <td colspan="3" class="text-right ">
                            <b>Total</b>
                        </td>
                        <td>
                            <b>Rp {{ number_format( $order->cart->total,2)}}</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right p-0 pt-2">

                            <form method="post" action="/transaksi/edit_process">
                                @csrf
                                <input type="hidden" value="{{ $order->id }}" name="id">
                                <div class="form-group">
                                    <input type="submit" class="form-control m-0 btn btn-primary " value="Pesanan diterima">
                                </div>
                            </form>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-left ">
                            <b style="color:red">Note </b>
                            <br>
                            Jika pesanan telah sampai silahkan tekan tombol <b style="color:red">Pesanan diterima</b>
                            <br>
                            Mohon periksa kelengkapan produk Anda
                            <br>
                            Jika ada keluhan/masalah silahkan hubungi CP yang tertera
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection