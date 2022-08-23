@extends('layouts_user.app')

@section('content')

<style>
    .a {
        margin-left: 3%;
        font-weight: bold;
    }

    body {
        background-color: white;
    }

    .p {
        max-height: 70px;
        min-height: 20px;
        width: auto
    }

    .act-btn {

        display: block;
        /* width: 50px; */
        height: 80px;
        line-height: 40px;
        text-align: center;
        color: white;
        font-size: 20px;
        font-weight: bold;
        /* border-radius: 50%; */
        /* -webkit-border-radius: 50%; */
        text-decoration: none;
        transition: ease all 0.3s;
        position: fixed;
        right: 10px;
        /* right: 40px; */
        bottom: 10px;
    }
</style>
<div class="container" style="margin-top:6%">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-5">
                <nav class="" pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color:black">Checkout</li>
                    </ol>
                </nav>

                @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                <div class="alert alert-warning">{{ $error }}</div>
                @endforeach
                @endif
                @if ($message = Session::get('error'))
                <div class="alert alert-warning">
                    <p>{{ $message }}</p>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="row">
                    <div class="col-lg-6 m-auto m-1">
                        <div class="a ">
                            Product
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped table-responsive">
                                <tbody>
                                    @foreach($detailcart as $detail)
                                    <tr>
                                        <td>
                                            {{$no++}}
                                        </td>
                                        <td>
                                        <td>
                                            <img src=" {{ url('/images/'.$detail->product->gambar) }}" class="img-fluid p">
                                        </td>
                                        </td>
                                        <td>
                                            {{ $detail->product->nama}}
                                            <br />
                                            Rp {{number_format(( $detail->product->harga)-($detail->diskon),2,',','.') }}
                                        </td>
                                        <td>
                                            x {{ number_format($detail->qty) }}
                                        </td>
                                        <td class="text-right" class="pr-0 mr-0 ml-5">
                                            Rp {{ number_format($detail->subtotal,2,',','.') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-right" colspan="5">
                                            <b>Subtotal</b>
                                        </td>
                                        <td class="text-right">
                                            <b> Rp {{ number_format($cart->subtotal,2,',','.') }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="5">
                                            <b>Ongkir</b>
                                        </td>
                                        <td class="text-right">Rp{{ number_format($cart->ongkir,2,',','.')}}
                                            @if($cart->status_ongkir == 1)
                                            <form action="{{ route('checkout.destroy', $cart->id) }}" method="post" style="display:inline;">
                                                @csrf
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </form>
                                            @else
                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('ongkir',$cart->id) }}">Cek ongkir</a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col col-lg-6">
                        <div class="a">
                            Alamat pengiriman
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped table-responsive ">
                                <tbody>
                                    @if($itemalamatpengiriman)
                                    <tr>
                                        <td colspan="2">
                                            {{ ucwords($itemalamatpengiriman->nama_penerima) }} | {{ $itemalamatpengiriman->no_tlp }}
                                            <br />
                                            {{ ucwords($itemalamatpengiriman->alamat) }}<br />
                                            {{ ucwords ($itemalamatpengiriman->kelurahan)}}, {{ ucwords($itemalamatpengiriman->kecamatan)}}<br />
                                            {{ ucwords($itemalamatpengiriman->city->name)}}, {{ ucwords ($itemalamatpengiriman->province->name)}} - {{ ucwords($itemalamatpengiriman->kodepos)}}
                                        </td>
                                        <td>
                                            <a href="/alamatpengiriman" class="btn btn-outline-success btn-sm">
                                                Ubah Alamat
                                            </a>
                                        </td>
                                    </tr>
                                    @else
                                    <td>
                                        <a href="/alamatpengiriman" class="btn btn-outline-success btn-sm">
                                            Tambah Alamat
                                        </a>
                                    </td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="act-btn">
                    <div class="card ">
                        <div class="row">
                            <div class="col-md-12 mt-2" style="color:black">
                                <td>Total: Rp </td>
                                <td class="text-right">
                                    <b> {{ number_format($cart->total, 2,',','.') }}</b>
                                </td>
                            </div>
                            <div class="col p-0">
                                <form action="{{ route('transaksi.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cart_id" value={{ $cart->id }}>
                                    @if($cart->status_ongkir == 1)
                                    <button type="submit" class="btn btn-outline-primary btn-sm"> <i class="fa fa-shopping-cart"></i> buat pesanan</button>
                                    @endif
                                    @if($cart->status_ongkir == 0)
                                    <button type="submit" class="btn btn-outline-primary btn-sm" disabled> <i class="fa fa-shopping-cart"></i> buat pesanan</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection