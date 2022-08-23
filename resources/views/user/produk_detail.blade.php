@extends('master.master_user')
@include('layouts_user.header')
@section('content')
<style>
    .card-box {
        border: 1px solid #ddd;
        padding: 20px;
        /* box-shadow: 0px 0px 10px 0px #c5c5c5; */
        /* margin-bottom: 30px; */
        /* float: left; */
        border-radius: 10px;
    }

    .card-box .card-thumbnail {
        max-height: 400px;
        overflow: hidden;
        border-radius: 10px;
        transition: 1s;
    }

    .card-box .card-thumbnail:hover {
        transform: scale(1.5);
    }

    .card-box h3 a {
        font-size: 20px;
        text-decoration: none;
    }

    /* ////// */

    .box-bg {
        background-color: #fff;
        /* padding: 15px 15px; */
        /* border: 2px solid #e2e2e2; */
        /* border-top-left-radius: 40px;
        border-bottom-right-radius: 40px; */
        position: relative;
        /* margin: 15px 0px; */
        overflow: hidden;
    }

    .social-links {
        width: 100%;
        position: absolute;
        top: -150px;
        left: 0px;
        background-color: rgba(0, 0, 0, 0.6);
        height: 30%;
        padding: 5px 0px;
        transition: 1s;
    }

    .box-bg:hover .social-links {
        top: 0px;
    }

    .social-links ul {
        padding: 0px;
        margin: 0px;
    }

    .social-links ul li {
        list-style: none;
        float: left;
        width: 100%;
    }

    .social-links ul li a {
        text-align: center;
        display: block;
        color: #607D8B;
        margin: 1% auto;
        text-decoration: none;
        color: white;
    }

    .social-links ul li a:hover {
        font-size: 20px;
        color: #997950;
    }

    .social-links h4 {
        color: #fff;
        /* padding-bottom: 15px; */
    }


    /* lllll */

    /* section.our-team {
        padding: 70px 0px;
        background-color: #f2f9ff;
        text-align: center;
        color: #fff;
    } */
    .member {
        text-align: center;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
        transition: 0.4s;
        /* border-radius: 100%;
        border: 6px solid #ffffff; */
    }

    /* .our-team h2 {
        font-size: 36px;
        color: #795548;
        font-weight: normal;
    }

    .our-team p {
        color: #9e9e9e;
        width: 70%;
        margin: 10px auto 10px;
    } */

    .member:hover {
        box-shadow: 0px 10px 0px 0px #795548;
    }

    .member .member-info {
        position: absolute;
        bottom: 0;
        top: 0;
        left: 0;
        right: 0;
        opacity: 0;
    }

    .member .member-detail {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 10px;
    }

    .member .social {
        position: absolute;
        left: 0;
        bottom: -38px;
        right: 0;
        height: 48px;
        transition: bottom ease-in-out 0.4s;
        text-align: center;
    }

    .member .social a {
        margin: 0 10px;
        display: inline-block;
        color: white;
    }

    .member .social a:hover {
        /* color: #795548; */
        color: #43270f;
    }



    .member .social i {
        font-size: 18px;
        margin: 0 2px;
    }

    .member:hover .member-info {
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.83) 0%, rgba(0, 0, 0, 0.57) 20%, rgba(121, 85, 72, 0.09) 100%);
        opacity: 1;
        transition: 0.4s;
    }

    .member:hover .member-detail {
        bottom: 80px;
    }

    .member:hover .social {
        bottom: 10px;
    }

    .btn:hover {
        background-color: black;
    }
</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card mt-1 mb-2">
                <div class="  row mt-2 mb-2" style="margin:auto">
                    <h3><b>Produk {{$clothes->nama}}</b></h3>
                </div>
                <div class="row justify-content-center m-1">
                    <div class="col-sm-6 col-md-4 col-lg-5">
                        <!-- Bootstrap 5 card box -->
                        <div class="box-bg mb-3 mt-4">
                            <!-- Bootstrap 5 card box -->
                            <div class="card-box text-center">
                                <div class="card-thumbnail">
                                    <img src="{{ url('/images/'.$clothes->gambar) }}" style="margin:3%" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class=" mt-4 mb-2  text-center">
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="clothes_id" value={{ $clothes->id }}>
                                    <button class="btn btn-block btn-primary" type="submit">
                                        <i class="fa fa-shopping-cart"></i> Tambahkan Ke Keranjang
                                    </button>
                                </form>


                                <!-- <button class="btn btn-danger">Add to <i class="fa-regular fa-heart"></i> -->
                                <form action="{{ route('wishlist.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="clothes_id" value={{ $clothes->id }}>
                                    <button type="submit" class="btn btn-danger">
                                        @if(isset($wishlist) && $wishlist)
                                        Remove from <i class="fas fa-heart"></i>
                                        @else
                                        Add to <i class="far fa-heart"></i>
                                        @endif
                                    </button>
                                </form>
                                <!-- </button> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-5 col-lg-5">
                        <!-- Bootstrap 5 card box -->
                        <div class="mb-3">
                            <div class="card-box  border-0 text-left">
                                <!-- <div class="member-detail"> -->
                                <h5 class="mt-2 text-active" style="text-decoration:none;color:black;"><b>{{$clothes->nama}}</b></h5>
                                <h4 style="color:red;line-height:2"><b>Rp {{$clothes->harga}}</b></h4>
                                <p><b>Size :</b> {{$clothes->ukuran}}</p>
                                <p>Warna<i class="fa-thin fa-circle">{{$clothes->color}}</i></p>
                                <h4 style="color:red;line-height:2"><b>Readyyyy</b> <i style="color:red;line-height:2" class="fa-solid fa-exclamation"></i></h4>
                                <p>{{$clothes->deskripsi}}</p>
                                <div>
                                    <p style="color:red;line-height:2"><b>Warning </b><i style="color:red;line-height:2" class="fa-solid fa-exclamation"></i></p>
                                    <p>Warna memiliki kemiripan <b>80-90%</b> dikarenakan efek cahaya</p>
                                    <p>Baju yang dijual telah dicuci serta disetrika sebelumnya</p>
                                    <p><b>No Complaint</b>, mohon cek detail pakaian pesanan anda <b><i class="fa-regular fa-face-smile-beam fa-2x"></i></b></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="kebijakan m-5">
                    <h4><b>Kebijakan Pengembalian</b></h4>
                    <p>Kebijakan pengembalian:
                        <br>1. Tersedia layanan gratis pengembalian melalui JNE
                        <br>2. Sertakan video unboxing <b>no cut</b> untuk pengembalian produk cacat ataupun
                        rusak serta salah kirim
                        <br>3. Kerusakan diakibatkan oleh pengiriman (terkena benda tajam) <b>bukan</b> tanggung jawab pihak 390 Second Stuff
                    </p>
                </div>
                <div class="kebijakan  ml-5">
                    <h4><b>Info Pengiriman</b></h4>
                    <p>Info Pengiriman:
                        <br>1. Pengiriman hanya tersedia melalui JNE, Pos Indonesia serta TIKI
                        <br>2. Jika ingin melakukan pengiriman melalui ekspedisi lain dapat menghubungi CP yang tertera
                        <br>3. Tidak tersedia pembayaran secara COD
                    </p>
                </div>

            </div>
        </div>




    </div>
</div>

@endsection