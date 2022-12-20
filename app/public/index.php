<?php
    $cssFile = "index";
    $pageTitle = "E3T";
    include "components/header.php";
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E3T - Home</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<main>
    <div id="top-background">

            <div class="textBanner">
                 <h1>Organise successful events<br> and discover talents with E3T</h1>
                                <div id="subTitle">
                                    <p>Discover talents and organise events in Emmen and<br> surroundings</p>
                                </div>
                                    <div id="button">
                                        <a href="events.php"><b>Discover Talents</b></a>
                                    </div>
                        </div>

    </div>

</main>

<section>
            <div id="events">
                <h1>Upcoming Events</h1>
            </div>

            <div class="slide-container swiper">
        <div class="slide-content">
        <div class="card-wrapper swiper-wrapper">
        <?php

            for ($i=0; $i<9; $i++) {
            echo ' <div class="card swiper-slide">
            <div class="image-content">
                    <src="#">
                </div>


            <div class="event-content">
                <h2 class="name">Name of Event</h2>
                <p class="description">The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.</p>

                <button class="button">View Event</button>
            </div>
        </div>';
}
?>
        </div>
    </div>
    <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
</div>

</section>

    </body>
             
            <script src="js/swiper-bundle.min.js"></script>
             <script src="js/script.js"></script>
        </html>

<?php
include "components/footer.php";
?>
