<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap');

    /*-- VARIABLES CSS--*/
    /*Colores*/
    :root {
        --first-color: #d3d3d3;
        --second-color: #191919;
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


        background-color: #fff;
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


    .bd-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        max-width: 2000px;
        margin-left: 2.5rem;
        margin-right: 2.5rem;
        align-items: center;
        gap: 2rem;
    }

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
    .card {
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
        color: var(--accent-color);
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
        color: var(--accent-color);
        margin-bottom: .25rem;
    }

    .card__preci--now {
        font-size: var(--h3-font-size);
        font-weight: bold;
    }

    /*Move left*/
    .card:hover {
        box-shadow: 0 .5rem 1rem #D1D9E6;
    }

    .card:hover .card__name {
        left: 0;
    }

    .card:hover .card__img {

        margin-left: 3.5rem;
    }

    .card:hover .card__precis {
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
</style>


<body>
    <div class="para">
        <h1 class="title-shop">SHOP</h1>
        <main class="main justify-content-center bd-grid  m-auto">
            <article class="card mr-2 ml-2">
                <div class="card__img">
                    <img src="{{ asset('../images/1644932447_Vintage Tshirt LL Bean-depositphotos-bgremover.png') }}" alt="">
                </div>
                <div class="card__name">
                    <p>390s SECOND STUFF</p>
                </div>
                <div class="card__precis">
                    <a href="" class="card__icon">
                        <ion-icon name="heart-outline"></ion-icon>
                    </a>

                    <div>
                        <span class="card__preci card__preci--before">$990.00</span>
                        <span class="card__preci card__preci--now">$749.00</span>
                    </div>
                    <a href="" class="card__icon">
                        <ion-icon name="cart-outline"></ion-icon>
                    </a>
                </div>
            </article>

            <article class="card mr-2 ml-2">
                <div class="card__img">
                    <img src="{{ asset('../images/1644932447_Vintage Tshirt LL Bean-depositphotos-bgremover.png')}}" alt="">
                </div>
                <div class="card__name">
                    <p>AIR ZOOM PEGASUS</p>
                </div>
                <div class="card__precis">
                    <a href="" class="card__icon">
                        <ion-icon name="heart-outline"></ion-icon>
                    </a>
                    <div>
                        <span class="card__preci card__preci--before">$990.00</span>
                        <span class="card__preci card__preci--now">$749.00</span>
                    </div>
                    <a href="" class="card__icon">
                        <ion-icon name="cart-outline"></ion-icon>
                    </a>
                </div>
            </article>

            <article class="card mr-2 ml-2">
                <div class="card__img">
                    <img src="{{ asset('../images/1644932447_Vintage Tshirt LL Bean-depositphotos-bgremover.png')}}" alt="">
                </div>
                <div class="card__name">
                    <p>AIR ZOOM PEGASUS</p>
                </div>
                <div class="card__precis">
                    <a href="" class="card__icon">
                        <ion-icon name="heart-outline"></ion-icon>
                    </a>

                    <div>
                        <span class="card__preci card__preci--before">$990.00</span>
                        <span class="card__preci card__preci--now">$749.00</span>
                    </div>
                    <a href="" class="card__icon">
                        <ion-icon name="cart-outline"></ion-icon>
                    </a>
                </div>
            </article>

            <article class="card mr-2 ml-2">
                <div class="card__img">
                    <img src="assets/img/img4.png" alt="">
                </div>
                <div class="card__name">
                    <p>AIR ZOOM PEGASUS</p>
                </div>
                <div class="card__precis">
                    <a href="" class="card__icon">
                        <ion-icon name="heart-outline"></ion-icon>
                    </a>

                    <div>
                        <span class="card__preci card__preci--before">$990.00</span>
                        <span class="card__preci card__preci--now">$749.00</span>
                    </div>
                    <a href="" class="card__icon">
                        <ion-icon name="cart-outline"></ion-icon>
                    </a>
                </div>
            </article>
            <article class="card mr-2 ml-2">
                <div class="card__img">
                    <img src="{{ asset('../images/1644932447_Vintage Tshirt LL Bean-depositphotos-bgremover.png') }}" alt="">
                </div>
                <div class="card__name">
                    <p>AIR ZOOM PEGASUS</p>
                </div>
                <div class="card__precis">
                    <a href="" class="card__icon">
                        <ion-icon name="heart-outline"></ion-icon>
                    </a>

                    <div>
                        <span class="card__preci card__preci--before">$990.00</span>
                        <span class="card__preci card__preci--now">$749.00</span>
                    </div>
                    <a href="" class="card__icon">
                        <ion-icon name="cart-outline"></ion-icon>
                    </a>
                </div>
            </article>
            <article class="card mr-2 ml-2">
                <div class="card__img">
                    <img src="{{ asset('../images/1644932447_Vintage Tshirt LL Bean-depositphotos-bgremover.png') }}" alt="">
                </div>
                <div class="card__name">
                    <p>AIR ZOOM PEGASUS</p>
                </div>
                <div class="card__precis">
                    <a href="" class="card__icon">
                        <ion-icon name="heart-outline"></ion-icon>
                    </a>

                    <div>
                        <span class="card__preci card__preci--before">$990.00</span>
                        <span class="card__preci card__preci--now">$749.00</span>
                    </div>
                    <a href="" class="card__icon">
                        <ion-icon name="cart-outline"></ion-icon>
                    </a>
                </div>
            </article>
        </main>

        <!-- ICONS -->
        <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    </div>
</body>

</html>
<button onclick="myFunction()" id="myButton" value="Open Curtain">Open Curtain</button>
<script>
    function myFunction() {

        var btn = document.getElementById("myButton");

        if (btn.value == "Open Curtain") {
            btn.value = "Close Curtain";
            btn.innerHTML = "Close Curtain";
        } else {
            btn.value = "Open Curtain";
            btn.innerHTML = "Open Curtain";
        }

    }
</script>