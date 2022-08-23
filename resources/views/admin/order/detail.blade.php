@extends('layouts_admin.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-5">
                <div class="page-header-content header-elements-md-inline" style="background-color:#e9ecef">
                    <div class="page-title d-flex" style="padding-top:1% !important;padding-bottom:1% !important">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Detail Pesanan</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none py-0 mb-3 mb-md-0">
                        <div class="breadcrumb">
                            <a href="/dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Detail Pesanan</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 m-auto m-1">
                    <div class="a ml-3 mt-3">
                        <b>
                            Detail Transaksi
                        </b>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div>
                                    <b> Alamat Pengiriman</b>
                                </div>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <b> {{ucwords( $order->nama_penerima) }}</b> | {{ $order->no_tlp }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{ ucwords($order->alamat) }}<br />
                                                {{ ucwords($order->kelurahan)}}, Kec. {{ucwords ($order->kecamatan)}}, Kab. {{ucwords ($order->kota)}}, {{ ucwords($order->provinsi)}}
                                                <br />Kode Pos {{ $order->kodepos}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-8">
                                <div>
                                    <b> Status</b>
                                </div>
                                <div>
                                    <table>
                                        <tr>
                                            <td>
                                                Status Pembayaran
                                            </td>
                                            <td> : </td>
                                            <td style="color:blue">
                                                {{ $order->status_bayar->keterangan}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Status Pengiriman
                                            </td>
                                            <td> : </td>
                                            <td style="color:green">
                                                {{ $order->status_kirim->keterangan}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Pengiriman
                                            </td>
                                            <td> : </td>
                                            @if($order->jasa == 'tiki')
                                            <td>Tiki</td>
                                            @elseif($order->jasa == 'pos')
                                            <td>Pos Indonesia</td>
                                            @elseif ($order->jasa == 'jne')
                                            <td>JNE</td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <td>
                                                No resi
                                            </td>
                                            <td> : </td>
                                            <td>
                                                {{ $order->no_resi}}
                                            </td>

                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-8">
                                <div><b>Detail Pesanan</b></div>
                                <div class="card-body">
                                    <table class="table table-stripped table-responsive">
                                        <tbody>
                                            <tr>
                                                Total item : {{$order->total_item}}
                                            </tr>
                                            @foreach($order->cart->detail as $detail)
                                            @if($detail->status ==1)
                                            <tr style="border: 1px">
                                                <td>
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
                                            @endif
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
                                                    <b>Rp {{ number_format( $order->cart->total,2,',','.')}}</b>
                                                </td>
                                            </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection