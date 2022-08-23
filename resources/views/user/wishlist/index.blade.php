@extends('master.master_user')

<style>
    .p a:hover {
        background-color: #6c757d !important;
    }

    .navbar a:hover {
        background-color: #6c757d;
    }

    .icon-wrapper a:hover {
        background-color: #6c757d;
    }

    .icon-wrapper {
        position: relative;
        float: left;
    }

    *.icon-blue {
        color: #0088cc
    }

    *.icon-grey {
        color: red
    }

    i {

        text-align: center;
        vertical-align: middle;
    }


    .badge {
        background: white;
        color: red;
        width: auto;
        height: auto;
        margin: 0;
        border-radius: 50%;
        position: absolute;
    }
</style>


<div id="app" style="margin-bottom:1%">
    <nav id="navbar_top" class=" shadow-md navbar stiky-top navbar-expand-lg navbar-dark " style="background-color: #262b2f;text-shadow: 0px 13px 11px 3px rgba(158, 158, 158, 0.95);">
        <div class="container">
            <li>
                <a class="navbar-brand active" href="#">
                    <img src="{{ asset('../images/logo.png') }}" width="150px" height="auto" class="d-inline-block align-top " alt="">
                </a>
            </li>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item active mr-3">
                        <a class="nav-link" href="/">Home </a>
                    </li>

                    <li class="nav-item dropdown mr-3">
                        <a id="navbarDropdown" class="nav-link active dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Kategori
                        </a>
                        <div class="p dropdown-menu" aria-labelledby="navbarDropdown" style="background-color:#262b2f">
                            <a class="dropdown-item " style="color:white" href="/produk_tshirt">T'shirt</a>
                            <a class=" dropdown-item" style="color:white" href="/produk_sweater">Crewneck</a>
                        </div>
                    </li>

                    <li class="nav-item active mr-3">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item active mr-3">
                        <a class="nav-link" href="#">Review</a>
                    </li>
                    <form class="form-inline " action="/produk_search" method="GET">
                        <input style="margin-right:100px!important" class="form-control mr-5 col-lg-12" type="search" placeholder="Search" value="{{ old('cari') }}" name="cari">
                    </form>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto mr-3">
                    <!-- Authentication Links -->

                    <li class="nav-item active mr-3">
                        <a class="nav-link" href="/wishlist">
                            <div class="icon-wrapper">
                                <i class="fa fa-heart  icon-grey"></i>
                                <span class="badge">{{$wishlist->total()}}</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item active mr-3">
                        <a class="nav-link" href="/cart"><i class="fa fa-cart-plus"></i></a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link active dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color:#262b2f">

                            <a class="dropdown-item" href="/user_detail" style="color:white"> My Profile </a>
                            <a style="color:white" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        document.getElementById('navbar_top').classList.add('fixed-top');
                        // add padding top to show content behind navbar
                        navbar_height = document.querySelector('.navbar').offsetHeight;
                        document.body.style.paddingTop = navbar_height + 'px';
                    } else {
                        document.getElementById('navbar_top').classList.remove('fixed-top');
                        // remove padding top from body
                        document.body.style.paddingTop = '0';
                    }
                }

            );
        }

    );
</script>
<style>
    .navbar {
        box-shadow: 0px 4px 20px -4px rgba(194, 194, 194, 1) !important;
    }

    .p {
        box-shadow: -1px 31px 36px -7px rgba(179, 179, 179, 0.72);
        -webkit-box-shadow: -1px 31px 36px -7px rgba(179, 179, 179, 0.72);
        -moz-box-shadow: -1px 31px 36px -7px rgba(179, 179, 179, 0.72);
    }
</style>
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
        float: left;
        /* border-radius: 100%;
        border: 6px solid #ffffff; */
    }

    /* .our-team h2 {
        font-size: 36px;
        color: #6c757d;
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
        color: black;
        /* transform: scale(1.7); */
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
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card mt-1 mb-2">
                <div class="card-header">
                    <h3 class="card-title">Wishlist</h3>

                </div>
                <div class="card-body">
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
                    <div class="row  m-1">
                        @foreach($wishlist as $wish)
                        <div class=" col-lg-3">
                            <!-- Bootstrap 5 card box -->
                            <div class="member mb-3">
                                <div class="card-box text-center ">
                                    <div class="card-thumbnail" style="background-color:white;border:1px">
                                        <img src="{{ url('/images/'.$wish->clothes->gambar) }}" style="margin:3%" class="img-fluid" alt="">
                                        <h5><a href="#" class="mt-2 text-active" style="text-decoration:none;color:black">{{$wish->clothes->nama}}</a></h5>
                                        <p class="" style="color:red">Rp {{$wish->clothes->harga}}</p>
                                    </div>
                                    <!-- <div class="member-detail"> -->
                                    <!-- <h5><a href="#" class="mt-2 text-active" style="text-decoration:none;color:white;">{{$wish->clothes->nama}}</a></h5>
                                <p class="text-white">Rp {{$wish->clothes->harga}}</p> -->
                                    <!-- </div> -->
                                    <div class="member-info">
                                        <div class="member-detail">
                                            <div class="social">
                                                <form action="{{ route('wishlist.destroy', $wish->id) }}" method="post" style="display:inline;">
                                                    @csrf
                                                    {{ method_field('delete') }}<button class=" btn-danger p-2" type="submit"><i class=" fa fa-trash"></i></button>
                                                </form>
                                                <button class=" btn-info p-2"><a href="#"><i class="fa fa-cart-plus"></i></a></button>
                                                <button class=" btn-secondary p-2"><a href="/produk_detail/{{ $wish->clothes->nama }}"><i class="fa fa-circle-info"></i></a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        @endforeach
                    </div>
                    {{ $wishlist->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection