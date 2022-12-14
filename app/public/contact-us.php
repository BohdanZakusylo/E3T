<?php
$cssFile = "contact-us";
$pageTitle = "contact-us";
include ("components/header.php");
?>
<div id="body">
    <div id="header_2">
        <h1 class="header_2_text">Contact Us</h1>
        <p class="header_text">Do you want E3T to host your events? or do are you a new talent that
            wants to join E3T?, kindly reach out to us using the contact forms below
        </p>
    </div>
    <form id="talent_form" method="POST" action="contact-us.php" enctype="multipart/form-data">
        <h1 class="for_talent">For talents</h1>
        <label class="label_1" for="full_name">Full name:</label><br>
        <input type="text" name="full_name" id="full_name" placeholder="Enter your full name here"><br>
        <label class="label_1" for="email_address">Email Address:</label><br>
        <input type="email" name="email_address" id="email_address" placeholder="Enter your email address here"><br>
        <label class="label_1" for="talent">Talent</label><br>
        <input type="text" name="talent" id="talent" placeholder="Enter your talent here"><br>
        <label class="label_1" for="description">Give a description of what you do</label><br>
        <textarea name="description" id="description" placeholder="Description..."></textarea><br>
        <p>
            <input type="submit" name="submit" value="Submit">
        </p>
    </form>

    <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if(isset($_POST["submit"])){
                    $fullName = filter_input(INPUT_POST, "full_name");
                    $emailAddress = filter_input(INPUT_POST, "email_address", FILTER_VALIDATE_EMAIL);
                    $talent = filter_input(INPUT_POST, "talent");
                    $description = filter_input(INPUT_POST, "description");

                    if(empty($fullName)){
                        echo "Please provide all necessary information";
                    } elseif(empty($emailAddress)) { 
                        echo "Please provide all necessary information";
                    }else if(empty($talent)) {
                        echo "Please provide all necessary information";
                    } elseif(empty($description)) {
                        echo "Please provide all necessary information";
                    } elseif(str_word_count($fullName) < 2) {
                        echo "Your full name must contain at least 2 words";
                    } elseif(str_word_count($description) < 5){
                        echo "Your description needs to contain at least 5 words";
                    } elseif(strlen($talent) < 3){
                        echo "Your talent name needs to contain at least 3 characters";
                    }else {
                            echo "Thank you for contacting us!<br>";
                            echo "Full Name: ".$fullName."<br>";
                            echo "E-mail: ".$emailAddress."<br>";
                            echo "Talent: ".$talent."<br>";
                            echo "Description: ".$description."<br>";
                            echo "We will contact you as soon as possiblie via your E-mail Address";
                    }
                }
            }
            ?>



    <form id="client_form" method="POST" action="contact-us.php" enctype="multipart/form-data">
        <div class="vertical_line">
            <h1 class="for_client">For clients</h1>
            <label class="label_2" for="full_name_2">Full name:</label><br>
            <input type="text" class="form_2" name="full_name_2" id="full_name_2" placeholder="Enter your full name here"><br>
            <label class="label_2" for="email_address_2">Email Address:</label><br>
            <input type="email" class="form_2" name="email_address_2" id="email_address_2" placeholder="Enter your email address here"><br>
            <label class="label_2" for="name_of_event">Name of Event:</label><br>
            <input type="text" class="form_2" name="name_of_event" id="name_of_event" placeholder="What is the name of event"><br>
            <label class="label_2" for="event_description">Description of event</label><br>
            <textarea class="textarea_1" name="event_description" id="event_description" placeholder="Describe the event..."></textarea><br>
            <p>
                <input class="submit_2" type="submit" name="submit_2" value="Submit">
            </p>
        </div>
    </form>

    <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if(isset($_POST["submit_2"])){
                    $fullName2 = filter_input(INPUT_POST, "full_name_2");
                    $emailAddress2 = filter_input(INPUT_POST, "email_address_2", FILTER_VALIDATE_EMAIL);
                    $event = filter_input(INPUT_POST, "name_of_event");
                    $eventDescription = filter_input(INPUT_POST, "event_description");

                    if(empty($fullName2)){
                        echo "Please provide all necessary information";
                    } elseif(empty($emailAddress2)) { 
                        echo "Please provide all necessary information";
                    }else if(empty($event)) {
                        echo "Please provide all necessary information";
                    } elseif(empty($eventDescription)) {
                        echo "Please provide all necessary information";
                    } elseif(str_word_count($fullName2) < 2) {
                        echo "Your full name must contain at least 2 words";
                    } elseif(str_word_count($eventDescription) < 5){
                        echo "Your event description needs to contain at least 5 words";
                    } elseif(strlen($event) < 3){
                        echo "Your event name needs to contain at least 3 characters";
                    }else {
                            echo "Thank you for contacting us!<br>";
                            echo "Full Name: ".$fullName2."<br>";
                            echo "E-mail: ".$emailAddress2."<br>";
                            echo "Event: ".$event."<br>";
                            echo "Event description: ".$eventDescription."<br>";
                            echo "We will contact you as soon as possiblie via your E-mail Address";
                    }
                }
            }
            ?>


</div>
<?php
include "components/footer.php";
?>
