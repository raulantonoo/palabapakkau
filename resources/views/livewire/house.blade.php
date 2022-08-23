@include('layouts_user.slider')
<style>
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
        margin: 0 2.5rem;
    }

    .title-shop::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 72px;
        height: 2px;
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
        background-color: black;
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
        color: #FFEFEF;

    }

    .social-links h4 {
        color: #fff;
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

    .btn {
        transition-duration: 0.4s;
    }

    .card_icon:hover {
        /* background-color: #4CAF50; */
        /* Green */
        /* color: #EC994B; */
        color: red;
        font-weight: bold;

    }
</style>


<div class="container">
    <div class="col-md-11 p-0 m-auto">
        <div class="card  mt-2 m-2">
            <div class="row mt-2 mb-2" style="margin:auto">
                <h3><b>Kategori</b></h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="box-bg mb-3">
                        <!-- Bootstrap 5 card box -->
                        <div class="card-box text-center">
                            <div class="card-thumbnail">
                                <img src="{{ asset('../images/baju.jfif') }}" style="margin:3%" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="social-links">
                            <ul>
                                <li><a href="{{ route('product-tshirt') }}"><i class="fa-solid fa-shirt"></i> <br> <b>Tshirt</b></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col sm-6 col-md-5 col-lg-4">
                    <!-- Bootstrap 5 card box -->
                    <div class="box-bg">
                        <div class="card-box text-center">
                            <div class="card-thumbnail">
                                <img src="{{ asset('../images/crewneck.jfif') }}" style="margin:3%" class="img-fluid" alt="https://www.michaels.com/gildan-mens-crewneck-sweatshirt/M20001446.html">
                            </div>
                        </div>
                        <div class="social-links">
                            <ul>
                                <li><a href="{{ route('product-sweater') }}"><i class="fa-solid fa-mitten"></i><br><b>Crewneck</b></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card m-2 " style="background-color:white">
        <h1 class="title-shop mt-3">PRODUK</h1>
        <main class="main justify-content-center bd-grid">
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

        <div class="form-group " style="margin:auto; margin-bottom:1%">
            <button class="btn btn-secondary text-center"><a href="{{ route('product-all') }}" style="text-decoration:none; color:white;">
                    Show more</a>
            </button>
        </div>
    </div>
</div>

<!-- ICONS -->
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js">
</script>



<!-- </body> -->