<style>
    footer {
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        padding: 5px 0px;
        background-color: black;
    }

    footer .social-links {
        text-align: center;
        /* margin: 20px 0px; */
        margin-top: 2%;
    }

    footer .social-btn {
        display: inline-block;
        width: 50px;
        height: 50px;
        background: #2f4f4f;
        margin: 10px;
        border-top-left-radius: 20px;
        border-bottom-right-radius: 20px;
        box-shadow: 0px 5px 10px 0px #909090;
        color: #ffffff;
        overflow: hidden;
        position: relative;
        border: 1px dotted #fff;
    }

    footer .social-btn i {
        line-height: 50px;
        font-size: 22px;
        transition: 0.2s linear;
    }

    footer .social-btn:hover i {
        transform: scale(1.3);
        color: #ff5722;
    }

    footer .social-btn::before {
        content: "";
        position: absolute;
        width: 120%;
        height: 120%;
        background: #ffffff;
        transform: rotate(45deg);
        left: -110%;
        top: 90%;
    }

    footer .social-btn:hover::before {
        animation: effect 0.6s 1;
        top: -10%;
        left: -10%;
    }

    footer p a {
        color: #ff5722;
    }

    /*-- Hover Animation Effect --*/
    @keyframes effect {
        0% {
            left: -120%;
            top: 100%;
        }

        50% {
            left: 10%;
            top: -30%;
        }

        100% {
            top: -10%;
            left: -10%;
        }
    }


    /*-- Footer Responsive CSS --*/
    @media (max-width: 576px) {
        footer .social-btn {
            width: 40px;
            height: 40px;
            margin: 5px;
        }

        footer .social-btn i {
            line-height: 40px;
            font-size: 18px;
        }
    }

    /*-- Footer CSS --*/
</style>

<footer>

    <div class="row m-0">
        <div class="col-md-8 offset-md-2">
            <div class="social-links bg-blue">
                <a class="social-btn" href="#">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="social-btn" href="https://www.instagram.com/390ssecondstuff/">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="social-btn" href="https://wa.me/6287703331974">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>

            <p class="text-center " style="color:white">
                Copyright © 2020 - 2021
            </p>
        </div>
    </div>
    </div>
</footer>