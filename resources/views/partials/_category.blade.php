<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMi Chaft</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

    <style>
        body {
            scroll-behavior: smooth;
        }

        header {
            background-color: white;
            padding: 10px;
            border: black;
            filter: drop-shadow(0px 4px 10px rgba(0, 0, 0, 0.5));
            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* a {
            display: block;
            text-decoration: none;
            color: black;
            font-size: 30px;
            background-color: #ace5e2;
            padding: 10px;
        } */

        .suggestions ul {
            list-style: none;
            padding: 0px;
            width: 465px;
            align-items: center;
            justify-content: center;
        }

        ul li {
            margin-bottom: 10px;
        }

        .searchbox ul li a:hover {
            color: #b23b61;
            background: #ecd1da;
        }

        .searchbox ul li:hover {
            transform: translateX(20px);
        }

        .suggestions li {
            overflow: hidden;
            height: 0;
            transition: all 0.3s ease-in-out;
        }

        input[type="search"]:focus + .suggestions li {
            height: 63px;
        }

        .byline {
            text-align: center;
            font-size: 18px;
        }

        .byline a {
            text-decoration: none;
            color: black;
        }

        h2 {
            position: relative;
            color: #000;
            font-size: 3.5rem;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            text-align: center;
        }

        h2:before,
        h2:after {
            content: "";
            display: block;
            width: 30%;
            height: 1.4375rem;
            background: #D1EAF0;
            left: 0;
            top: 40%;
            border-radius: 1.375rem;
            position: absolute;
        }

        .owl-carousel .owl-stage {
            display: flex;
        }

        .owl-carousel .owl-item {
            flex: 0 0 auto;
            margin-right: 15px;
        }

        span {
            font-size: 70px;
            position: relative;
            top: -5px;
        }

        .owl-carousel .item {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }

        .owl-carousel .item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .owl-carousel .item .image-text {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            background-color: #D1EAF0;
            color: black;
            text-align: center;
            font-size: 18px;
        }

        .owl-carousel .owl-item .item-inner {
            height: 200px;
        }

        .about {
            margin-top: 10rem;
            background: rgba(209, 234, 240, 1);
            position: relative;
            padding: 120px;
            height: 60vh;
        }

        .about h4 {
            position: relative;
            text-align: center;
            font-family: "Montserrat Thin";
            font-style: normal;
            font-weight: 600;
            font-size: 3.5rem;
            bottom: 35rem;
            letter-spacing: 2px;
            left: 12rem;
        }

        .logo {
            position: relative;
            align-items: center;
            justify-content: center;
        }

        .h5 a {
            font-family: "Montserrat Thin";
            font-weight: 100;
            font-size: 20px;
            text-decoration: none;
            width: 100px;
            height: 20px;
        }

        .btn_style_9 {
            display: inline-block;
            width: 20%;
            padding: 10px 20px;
            background: #069187;
            border: 2px solid #069187;
            color: #fff;
            text-transform: uppercase;
            position: relative;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            font-size: 4px;
            left: 48%;
            bottom: 10rem;
        }

        .btn_style_9 span {
            position: relative;
            display: inline-block;
            animation: button-roll-out .5s forwards cubic-bezier(.165,.84,.44,1);
        }

        .btn_style_9:hover span {
            animation: button-roll-over .5s forwards cubic-bezier(.165,.84,.44,1);
        }

        .btn_style_9::before {
            content: " ";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            transform-origin: bottom left;
            transition: transform .5s cubic-bezier(.77,0,.175,1);
            background-color: #fff;
            transform: scaleY(0);
            -webkit-transform: scaleY(0);
        }

        .btn_style_9:hover::before {
            transform: scaleY(1);
            -webkit-transform: scaleY(1);
        }

        .btn_style_9:hover {
            color: #069187;
        }

        @keyframes button-roll-over {
            35% { transform: translateY(10px); }
            35.001% { color: #069187; transform: translateY(-20px); }
            100% { color: #069187; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <h2 class="font-bold">CATEGORIES</h2>

    <div class="owl-slider">
        <div id="carousel" class="owl-carousel">
            <div class="item">
                <img src="images/gadgets.jpeg" class="w-1/2" alt="1000X1000">
                <div class="image-text" style="font-size: 1.5rem;">Mobile</div>
            </div>
            <div class="item">
                <img src="images/outfits.jpeg" alt="">
                <div class="image-text" style="font-size: 1.5rem;">Outfits</div>
            </div>
            <div class="item">
                <img src="images/fashion.jpeg" alt="">
                <div class="image-text" style="font-size: 1.5rem;">Fashion & Accesories</div>
            </div>
            <div class="item">
                <img src="images/automotive.jpeg" alt="">
                <div class="image-text" style="font-size: 1.5rem;">Automotive</div>
            </div>
            <div class="item">
                <img src="images/hobbies.jpeg" alt="">
                <div class="image-text" style="font-size: 1.5rem;">Hobbies</div>
            </div>
            <div class="item">
                <img src="images/services.jpeg" alt="">
                <div class="image-text" style="font-size: 1.5rem;">Services</div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $("#carousel").owlCarousel({
                loop: true,
                margin: 20,
                responsiveClass: true,
                autoHeight: true,
                autoplay: false,
                nav: false,
                dots: false,
                navText: [],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1024: {
                        items: 4
                    },
                    1366: {
                        items: 4
                    }
                }
            });
        });
    </script>
</body>
</html>
