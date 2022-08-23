@extends('master.master_user')
@include('layouts_user.header')
@section('content')
<style>
    .page-item.active .page-link {
        z-index: 3;
        color: #fff !important;
        background-color: #6c757d !important;
        border-color: black !important;
        border-radius: 50%;
        padding: 6px 12px;
    }

    .page-link {
        z-index: 3;
        color: black !important;
        background-color: #fff;
        border-color: black;
        border-radius: 50%;
        padding: 6px 12px !important;
    }

    .page-item:first-child .page-link {
        border-radius: 30% !important;
    }

    .page-item:last-child .page-link {
        border-radius: 30% !important;
    }

    .pagination li {
        padding: 3px;
    }

    .disabled .page-link {
        color: #212529 !important;
        opacity: 0.5 !important;
    }
</style>
<style>
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
        color:#6c757d;
        font-weight: normal;
    }

    .our-team p {
        color: #9e9e9e;
        width: 70%;
        margin: 10px auto 10px;
    } */

    .member:hover {
        box-shadow: 0px 10px 0px 0px #6c757d;
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
        color: #6c757d;
        transform: scale(1.7);
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
            <div class="card mt-1 mb-2" style="background-color:white">
                <div class="  row mt-2 mb-2" style="margin:auto">
                    <h3><b>Produk tersedia</b></h3>
                </div>
                <div class="row justify-content-center m-1">
                    @foreach($clothes as $c)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <!-- Bootstrap 5 card box -->
                        <div class="member mb-3">
                            <div class="card-box text-center border-0">
                                <div class="card-thumbnail">
                                    <img src="{{ url('/images/'.$c->gambar) }}" style="margin:3%" class="img-fluid" alt="">
                                </div>
                                <!-- <div class="member-detail"> -->
                                <h5><a href="#" class="mt-2 text-active" style="text-decoration:none;color:black;">{{$c->nama}}</a></h5>
                                <p style="color:red">Rp {{$c->harga}}</p>
                                <!-- </div> -->
                                <div class="member-info">
                                    <div class="member-detail">
                                        <div class="social">
                                            <a href="#"><i class="fa fa-heart"></i></a>
                                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                                            <a href="/produk_detail/{{ $c->nama }}"><i class="fa fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>


        <!-- {{ $clothes->links('vendor.pagination.custom')}} -->
        {{ $clothes->links() }}
    </div>
</div>

@endsection