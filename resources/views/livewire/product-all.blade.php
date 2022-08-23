@extends('layouts_user.app')

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

    .member {
        text-align: center;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
        transition: 0.4s;

    }

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

    /* // */
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap');

    /*-- VARIABLES CSS--*/
    /*Colores*/
    :root {
        --first-color: #d3d3d3;
        --second-color: #999da0;
        --third-color: #FFE8DF;
        --accent-color: #FF5151;
        --dark-color: #161616;
    }

    /*Tipografia responsive*/
    :root {
        --body-font: 'Open Sans';
        --h1-font-size: 1.5rem;
        --h1-font-color: white;
        --h3-font-size: 1rem;
        --normal-font-size: 0.938rem;
        --smaller-font-size: 0.75rem;
    }

    @media screen and (min-width: 768px) {
        :root {
            --h1-font-size: 2rem;
            --normal-font-size: 1rem;
            --smaller-font-size: 0.813rem;
        }
    }

    /*-- BASE --*/
    *,
    ::after,
    ::before {
        box-sizing: border-box;
    }

    body {


        background-color: #e9e9e9;
        color: var(--dark-color);
        font-family: var(--body-font);
    }

    h1 {
        font-size: var(--h1-font-size);
    }

    img {
        max-width: 100%;
        height: auto;
    }

    a {
        text-decoration: none;
    }


    /*-- LAYAOUT --*/
    .main {
        padding-bottom: 2em;

    }

    .bd-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        max-width: 1200px;
        margin-left: 2.5rem;
        margin-right: 2.5rem;
        align-items: center;
        gap: 2rem;
    }

    /*-- PAGES --*/
    /*-- PAGES --*/
    .title-shop {
        position: relative;
        margin-left: 1.50rem !important;
    }

    .title-shop::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 72px;
        height: 3px;
        background-color: var(--dark-color);
        margin-left: .25rem;
    }

    /*-- COMPONENT --*/
    .cards {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.5rem 2rem;
        border-radius: 1rem;
        overflow: hidden;
    }

    article:nth-child(odd) {
        background-color: var(--first-color);
    }

    article:nth-child(even) {
        margin-top: 37%;
        background-color: var(--second-color);
        color: var(--h1-font-color);
    }


    .card__img {
        width: 180px;
        height: auto;
        padding: 3rem 0;
        transition: .5s;
    }

    .card__name {
        position: absolute;
        left: -25%;
        top: 0;
        width: 3.5rem;
        height: 100%;
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        text-align: center;
        background-color: var(--dark-color);
        color: #fff;
        font-weight: bold;
        transition: .5s;
    }


    .card__icon {
        font-size: 1.5rem;
        color: var(--dark-color);
    }

    .card__icon:hover {
        color: #FFEFEF;
        font-weight: bold;
    }

    .card__precis {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        transition: .5s;
    }

    .card__preci {
        display: block;
        text-align: center;
    }

    .card__preci--before {
        font-size: var(--smaller-font-size);
        color: black;
        font-weight: bold;
        margin-bottom: .25rem;
    }

    .card__preci--now {
        font-size: var(--h3-font-size);
        font-weight: bold;
        color: #800000;
    }

    /*Move left*/
    .cards:hover {
        box-shadow: 0 .5rem 1rem #D1D9E6;
    }

    .cards:hover .card__name {
        left: 0;
    }

    .cards:hover .card__img {

        margin-left: 3.5rem;
    }

    .cards:hover .card__precis {
        margin-left: 3.5rem;
        padding: 0 1.5rem;
    }

    /*-- MEDIA QUERIES --*/
    @media screen and (min-width: 1200px) {


        .title-shop {
            margin: 0 5rem;
        }

        .bd-grid {
            margin-left: auto;
            margin-right: auto;
        }
    }

    /* //// */
    .box-bg {
        background-color: #fff;

        position: relative;

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
        color: #6c757d;
    }

    .social-links h4 {
        color: #fff;
        /* padding-bottom: 15px; */
    }

    .card-box {
        border: 1px solid #ddd;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 30px;
        margin-bottom: 10px;
        max-height: max-content;
        border-radius: 10px;
    }

    .card-box .card-thumbnail {
        max-height: 200px;
        overflow: hidden;
        border-radius: 10px;
        transition: 1s;
    }

    .card-box .card-thumbnail:hover {
        transform: scale(1.2);
    }

    .card-box h3 a {
        font-size: 20px;
        text-decoration: none;
    }
</style>

<div class="container" style="margin-top:6%">
    <div class="card ">
        <nav pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 ">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Produk</li>

                <ul class="text-right ml-auto d-flex justify-content-end">
                    <form class="form-wrapper" action="/produk_search" method="GET">
                        <input name="cari" type="search" id="search" value="{{ old('cari') }}" required>
                        <button type="submit" value="Cari" id="submit">Cari</button>
                    </form>

                </ul>
            </ol>

        </nav>

        <div class="card " style="background-color:white">
            <h1 class="title-shop mt-3">PRODUK</h1>
            <main class="main justify-content-center bd-grid  ">

                @foreach($products as $c)
                <article class="cards mr-2 pr-3 pl-3 pt-2 ml-2">
                    <div class="col-md-12 pr-0 text-right">
                        @if ($c->promo >0)
                        <b class="ml-auto" style="color:red"> Disc {{ $c->promo *100}}%</b>
                        @endif
                        <b class="mr-0">
                            <a href="{{ route('produk_detail', $c->id) }}" class="card__icon">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                        </b>
                    </div>
                    <div class="card__img">
                        <img src="{{ url('/images/'.$c->gambar) }}" alt="">
                    </div>

                    <div class="card__name">
                        <p>390s SECOND STUFF</p>
                    </div>

                    <div class="card__precis">

                        <form class="card__icon" action="{{ route('wishlist.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value={{ $c->id }}>
                            <button type="submit" class="btn p-0">
                                <i class=" card__icon  far fa-heart fa-lg"></i>
                            </button>
                        </form>

                        <div>
                            <span class="card__preci card__preci--before">{{$c->nama}}</span>
                            @if ($c->promo >0)
                            <s style="color:red"><span style="color:red; font-size:smaller" class="card__preci card__preci--now">Rp {{number_format($c->harga, 2, ',','.')}}</span></s>
                            <span class="card__preci card__preci--now">Rp {{number_format($c->harga - ($c->harga * $c->promo), 2, ',','.')}}</span>
                            @else
                            <span class="card__preci card__preci--now">Rp {{number_format($c->harga, 2, ',','.')}}</span>
                            @endif
                        </div>

                        <form class="card__icon" action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value={{ $c->id }}>
                            @if($c->stok>0)
                            <button type="submit" class="  btn p-0">
                                <i class=" card__icon fa-solid fa-cart-plus fa-lg"></i>
                            </button>
                            @else
                            <button type="submit" class="  btn p-0" disabled>
                                <i class=" card__icon fa-solid fa-cart-plus fa-lg"></i>
                            </button>
                            @endif
                        </form>
                        <!-- <a href="{{ route('produk_detail', $c->id) }}" class="card__icon">
                        <ion-icon name="cart-outline"></ion-icon>
                    </a> -->

                    </div>
                </article>
                @endforeach
            </main>
            <div class="m-auto"> {{ $products->links('vendor.pagination.custom')}}</div>
        </div>

        <!-- ICONS -->
        <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>



        <!-- {{ $products->links() }} -->
    </div>
</div>
@endsection