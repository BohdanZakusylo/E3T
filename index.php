<?php
$cssFile = "index";
$pageTitle = "E3T";
include "components/header.php";
include("db_connection/connection.php");
try {
    $query = "SELECT * FROM Events";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
} catch (PDOException $ex) {
    echo "$ex";
}


?>
<link rel="stylesheet" href="css/swiper-bundle.min.css">
<link rel="stylesheet" href="css/style.css">
<main>
    <div id="top-background">
        <div class="textBanner">
            <h1>Organise successful events</h1>
                <h1>and discover talents with E3T</h1>

            <div id="subTitle">
                <p>Discover talents and organise events in Emmen and<br> surroundings</p>
            </div>
            <div id="button">
                <a href="talents.php"><b>Discover Talents</b></a>
            </div>
        </div>
    </div>
</main>
<section>
    <div id="events">
        <h2>Upcoming Events</h2>
    </div>
    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="swiper-wrapper">
                <!-- <img src='  '> -->
                <?php
                if ($result) {
                    foreach ($result as $value) {
                        echo '<div class="swiper-slide">
                                <div class="image-content">
                                <img src='.$value["image_url"].'/>
                                </div>
                                  <div class="event-content">
                                    <h2 class="name">' . $value["name"] . '</h2>
                                    <p class="description">' . $value["event_description"] . '</p>
                                    <a href="events.php"><button class="button">View Event</button></a>
                                  </div>
                               </div>';
                    }

                } else {
                    echo "<p class='error'>couldn't load events</p>";
                }

                ?>
            </div>
        </div>
        <div class="swiper-button-next swiper-navBtn"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
    </div>

</section>
<script src="js/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<?php
include "components/footer.php";
?>
