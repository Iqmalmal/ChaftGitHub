<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GMi Chaft</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

<!-- Include Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

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

.owl-carousel .owl-stage {
display: flex;
}

.owl-carousel .owl-item {
flex: 0 0 auto;
margin-right: 15px;
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
text-align: center;
font-size: 1.5rem;
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

/* Media queries for mobile */
@media (max-width: 768px) {
    .owl-carousel .item {
        border-radius: 10px;
    }

    .owl-carousel .item .image-text {
        font-size: 1rem;
    }

    .btn_style_9 {
        width: 40%;
        font-size: 12px;
        bottom: 5rem;
    }
}

</style>
</head>
<body>
    <h2 class="font-bold">CATEGORIES</h2>

    <div class="owl-container">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <a href="/?tag=Mobile">
                    <img src="images/gadgets.jpeg" class="w-1/2" alt="1000X1000"> <br>
                    <div class="image-text" style="font-size: 1.5rem;">Mobile</div>
                </a>
            </div>
            <div class="item">
                <a href="/?tag=Outfit">
                    <img src="images/outfits.jpeg" alt=""> <br>
                    <div class="image-text" style="font-size: 1.5rem;">Outfits</div>
                </a>
            </div>
            <div class="item">
                <a href="/?tag=Fashion">
                    <img src="images/fashion.jpeg" alt=""><br>
                    <div class="image-text" style="font-size: 1.5rem; ">Fashion</div>
                </a>
            </div>
            <div class="item">
                <a href="/?tag=Automotive">
                    <img src="images/automotive.jpeg" alt=""><br>
                    <div class="image-text" style="font-size: 1.5rem; ">Automotive</div>
                </a>
            </div>
            <div class="item">
                <a href="/?tag=Hobbies">
                    <img src="images/hobbies.jpeg" alt=""><br>
                    <div class="image-text" style="font-size: 1.5rem;">Hobbies</div>
                </a>
            </div>
            <div class="item">
                <a href="/?tag=Service">
                    <img src="images/services.jpeg" alt=""><br>
                    <div class="image-text" style="font-size: 1.5rem;">Services</div>
                </a>
            </div>
        </div>
    </div>

    <br><br>
    <div class="border"></div>
    <br>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
                items: 2, // Set the initial number of items to display
                loop: true, // Enable looping
                autoplay: true, // Enable autoplay
                autoplayTimeout: 3000, // Autoplay interval in milliseconds
                autoplayHoverPause: true, // Pause on hover
                dots: false, // Disable dots
                margin: 30, // Spacing between items (in px)
                responsive: { // Define responsive breakpoints
                    768: {
                        items: 2 // Number of items to display on screens with a width of 768px or higher
                    },
                    992: {
                        items: 3 // Number of items to display on screens with a width of 992px or higher
                    },
                    1200: {
                        items: 4 // Number of items to display on screens with a width of 1200px or higher
                    }
                }
            });
        });
    </script>



</body>
</html>

