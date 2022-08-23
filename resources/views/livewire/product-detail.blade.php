@extends('layouts_user.app')

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

    .act-btn {

        display: block;
        /* width: 50px; */
        height: 50px;
        line-height: 50px;
        text-align: center;
        color: white;
        font-size: 20px;
        font-weight: bold;
        /* border-radius: 50%; */
        /* -webkit-border-radius: 50%; */
        text-decoration: none;
        transition: ease all 0.3s;
        position: fixed;
        left: 10px;
        /* right: 40px; */
        bottom: 20px;
    }

    .act-btns {

        display: block;
        /* width: 50px; */
        height: 50px;
        line-height: 50px;
        text-align: center;
        color: white;
        font-size: 20px;
        font-weight: bold;
        /* border-radius: 50%; */
        /* -webkit-border-radius: 50%; */
        text-decoration: none;
        transition: ease all 0.3s;
        position: fixed;
        /* right: 40px; */
        left: 230px;
        bottom: 20px;
    }

    .card-box .p a {
        text-decoration: none;
        color: black;
    }

    /* style tab */
    /* flow button*/
    .tab {
        overflow: hidden;
        background-color: #e9ecef;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 14px;
        text-align: center;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        /* padding: 6px 12px; */
        border: 1px solid #ccc;
        border-top: none;
    }

    h4,
    .p {
        color: red;
        line-height: 2;
        font-weight: bold;
    }


    /* zoom */
    .photoGallery {
        padding: 30px 0px;
    }

    .photoGallery h2 {
        font-size: 40px;
        color: #2196F3;
    }

    .photoGallery p {
        font-size: 18px;
        color: #9e9e9e;
    }


    .gallery-columns .thumbnail {
        max-height: 600px;
        overflow: hidden;
        display: block;

    }

    .gallery-columns a img {
        transition: 1s;
        cursor: zoom-in;
    }

    .gallery-columns .thumbnail:hover img {
        transform: scale(1.07);
    }

    #baguetteBox-overlay .full-image img {
        border: 3px solid #fff;
        border-radius: 10px;
    }
</style>


<div class="container" style="margin-top:6%">
    <div class="card ">
        <nav pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Produk Detail</li>
            </ol>
        </nav>

        <div class="row mt-2 mb-2" style="margin:auto">
            <h3><b>Produk {{$product->nama}}</b></h3>
        </div>

        <div class="row justify-content-center m-1">
            <div class="col-sm-6 col-md-4 col-lg-5">
                <div class="gallery-columns mb-3 mt-4">
                    <div class="card-box text-center">
                        <div class="">
                            @if($product->stok>0)
                            <span class="badge badge-success ml-5 pl-5" style="color:blue;"> <i class="fas fa-check" style="color:blue"></i> Ready Stok</span>
                            @else
                            <span class="badge badge-danger"> <i class="fas fa-times"></i> Stok Habis</span>
                            @endif
                            <a href="{{ url('/images/'.$product->gambar) }}" class="thumbnail">
                                <img src="{{ url('/images/'.$product->gambar) }}" class="img-fluid" alt="Gallery Image">
                            </a>


                            <!-- <img src="{{ url('/images/'.$product->gambar) }}" style="margin:3%" class="img-fluid" alt=""> -->

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-5 col-lg-5">
                <div class="mb-3">
                    <div class="card-box  border-0 text-left">
                        <p style="color: blue"> <i class="fa-solid fa-arrow-left-long"></i><a href="/" style="text-decoration:none;color:blue"> Back to home</a></p>
                        <h5 class="mt-2 text-active" style="text-decoration:none;color:black;"><b>{{$product->nama}}</b></h5>
                        @if ($product->promo >0)
                        <s style="color:red"><span style="color:red; font-size:smaller" class="card__preci card__preci--now">Rp {{number_format($product->harga, 2, ',','.')}}</span></s>
                        <h4>Rp {{number_format($product->harga - ($product->harga * $product->promo), 2, ',','.')}}</h4>
                        @else
                        <h4>Rp {{number_format($product->harga, 2, ',','.' )}}</h4>
                        @endif


                        <p><b>Size :</b> {{$product->ukuran}}</p>
                        <h4>Readyyyy<i class="fa-solid fa-exclamation"></i></h4>
                        <p>{{$product->deskripsi}}</p>
                        <div>
                            <p class="p">Warning <i class="fa-solid fa-exclamation"></i></p>
                            <p>Warna memiliki kemiripan <b>80-90%</b> dikarenakan efek cahaya</p>
                            <p>Baju yang dijual telah dicuci serta disetrika sebelumnya</p>
                            <p><b>No Complaint</b>, mohon cek detail pakaian pesanan anda <b><i class="fa-regular fa-face-smile-beam fa-2x"></i></b></p>
                        </div>

                        <div class="tab ">
                            <button class="tablinks pl-3 pr-3" onclick="openCity(event, 'kebijakan')">Kebijakan Pengembalian</button>
                            <button class="tablinks pl-3 pr-3" onclick="openCity(event, 'pengiriman')">Info Pengiriman</button>
                        </div>

                        <div id="kebijakan" class="tabcontent p-2">
                            <p>Kebijakan pengembalian:
                                <br>1. Tersedia layanan gratis pengembalian melalui JNE
                                <br>2. Sertakan video unboxing <b>no cut</b> untuk pengembalian produk cacat ataupun
                                rusak serta salah kirim
                                <br>3. Kerusakan diakibatkan oleh pengiriman (terkena benda tajam) <b>bukan</b> tanggung jawab pihak 390 Second Stuff
                            </p>
                        </div>
                        <div id="pengiriman" class="tabcontent p-2">
                            <p>Info Pengiriman:
                                <br>1. Pengiriman hanya tersedia melalui JNE, Pos Indonesia serta TIKI
                                <br>2. Jika ingin melakukan pengiriman melalui ekspedisi lain dapat menghubungi CP yang tertera
                                <br>3. Tidak tersedia pembayaran secara COD
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 
            <form class="act-btns" action="{{ route('wishlist.store') }}" method="post">
                @csrf
                <input type="hidden" name="product_id" value={{ $product->id }}>


                <button type="submit" class="btn btn-info  btn-md">
                    Tambahkan <i class="far fa-heart fa-1.5x"></i>
                </button>


            </form> -->

            <!-- <form class="act-btn" action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value={{ $product->id }}>
                @if($product->stok>0)
                <button type="submit" class="btn btn-primary btn-md"> Masukkan<i class="fa-solid fa-cart-plus fa-1.5x"></i></button>
                @else
                <button class="btn btn-danger btn-md" disabled>Masukkan<i class="fa-solid fa-cart-plus fa-1.5x"></i></button>
                @endif
            </form> -->

        </div>
    </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- Baguettebox CSS for image popup -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
<script>
    // baguetteBox.run is predefined in Baguette Box JS
    baguetteBox.run('.gallery-columns');
</script>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

@endsection