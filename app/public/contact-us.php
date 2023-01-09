<?php
session_start();
$cssFile = "contact-us";
$pageTitle = "contact-us";
include ("components/header.php");
require "db_connection/connection.php";
?>

<div id="body">
    <div id="header_2">
        <h1 class="header_2_text">Contact Us</h1>
        <p class="header_text">Do you want E3T to host your events? or do are you a new talent that
            wants to join E3T?, kindly reach out to us using the contact forms below
        </p>
    </div>
    <?php 
     $fullNameErr = $emailAddressErr = $talentErr = $descriptionErr = "";
    ?>
    <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $fullNameErr = $emailAddressErr = $talentErr = $descriptionErr = "";
                    if(isset($_POST["submit"])){
                    $fullName = filter_input(INPUT_POST, "full_name");
                    $emailAddress = filter_input(INPUT_POST, "email_address", FILTER_VALIDATE_EMAIL);
                    $talent = filter_input(INPUT_POST, "talent");
                    $description = filter_input(INPUT_POST, "description");


                    if(empty($fullName)){
                        $fullNameErr = "Please provide all necessary information";
                    } elseif(empty($emailAddress)) { 
                        $emailAddressErr = "Please provide all necessary information";
                    } elseif(empty($talent)) {
                        $talentErr = "Please provide all necessary information";
                    } elseif(empty($description)) {
                        $descriptionErr = "Please provide all necessary information";
                    } elseif(str_word_count($fullName) < 2) {
                        $fullNameErr = "Your full name must contain at least 2 words";
                    } elseif(str_word_count($description) < 5){
                        $descriptionErr = "Your description needs to contain at least 5 words";
                    } elseif(strlen($talent) < 3){
                        $talentErr = "Your talent name needs to contain at least 3 characters";
                    }else {
                            echo "<div class='message1'>";
                            echo "<h2>Thank you for contacting us!</h2><br>";
                            echo "<b>Full Name:</b> ".$fullName."<br>";
                            echo "<b>E-mail:</b> ".$emailAddress."<br>";
                            echo "<b>Talent:</b> ".$talent."<br>";
                            echo "<b>Description:</b> ".$description."<br>";
                            echo "We will contact you as soon as possiblie via your E-mail Address.";
                            echo "</div>";
                            $full = explode(" ", $fullName);
                            $first_name = $full[0];
                            $last_name = $full[1];
                            $input = $db->prepare("INSERT INTO Requests (first_name, last_name, email, talent, description) VALUES (:first_name, :last_name, :email, :talent, :description)");
                            $input->bindParam(':first_name', $first_name);
                            $input->bindParam(':last_name', $last_name);
                            $input->bindParam(':email', $emailAddress);
                            $input->bindParam(':talent', $talent);
                            $input->bindParam(':description', $description);
                            $input->execute();

                    }
                }
            }
    ?>
    <?php 
    $fullName2Err = $emailAddress2Err = $eventErr = $eventDescriptionErr = "";
    ?>
    <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $fullName2Err = $emailAddress2Err = $eventErr = $eventDescriptionErr = "";
                    if(isset($_POST["submit_2"])){
                    $fullName2 = filter_input(INPUT_POST, "full_name_2");
                    $emailAddress2 = filter_input(INPUT_POST, "email_address_2", FILTER_VALIDATE_EMAIL);
                    $event = filter_input(INPUT_POST, "name_of_event");
                    $eventDescription = filter_input(INPUT_POST, "event_description");



                    if(empty($fullName2)){
                        $fullName2Err = "Please provide all necessary information";
                    } elseif(empty($emailAddress2)) { 
                        $emailAddress2Err = "Please provide all necessary information";
                    } elseif(empty($event)) {
                        $eventErr = "Please provide all necessary information";
                    } elseif(empty($eventDescription)) {
                        $eventDescriptionErr = "Please provide all necessary information";
                    } elseif(str_word_count($fullName2) < 2) {
                        $fullName2Err = "Your full name must contain at least 2 words";
                    } elseif(str_word_count($eventDescription) < 5){
                        $eventDescriptionErr = "Your event description needs to contain at least 5 words";
                    } elseif(strlen($event) < 3){
                        $eventErr = "Your event name needs to contain at least 3 characters";
                    }else {
                            echo "<div class='message2'>";
                            echo "<h2>Thank you for contacting us!</h2><br>";
                            echo "<b>Full Name:</b> ".$fullName2."<br>";
                            echo "<b>E-mail:</b> ".$emailAddress2."<br>";
                            echo "<b>Event:</b> ".$event."<br>";
                            echo "<b>Event description:</b> ".$eventDescription."<br>";
                            echo "We will contact you as soon as possiblie via your E-mail Address.";
                            echo "</div>";
                    }
                }
            }
    ?>
    <form id="talent_form" method="POST" action="contact-us.php" enctype="multipart/form-data">
        <h1 class="for_talent">For talents</h1>
        <label class="label_1" for="full_name">Full name:<span class="error">* <?php echo $fullNameErr;?></label><br>
        <input type="text" name="full_name" id="full_name" placeholder="Enter your full name here"><br>
        <label class="label_1" for="email_address">Email Address:<span class="error">* <?php echo $emailAddressErr;?></label><br>
        <input type="email" name="email_address" id="email_address" placeholder="Enter your email address here"><br>
        <label class="label_1" for="talent">Talent<span class="error">* <?php echo $talentErr;?></label><br>
        <select id="talent" name="talent">
            <option value="default" selected disabled>Choose your talent</option>
            <option value="singer">Singer</option>
            <option value="dancer">Dancer</option>
            <option value="actor">Actor</option>
            <option value="dj">DJ</option>
            <option value="magician">Magician</option>
            <option value="comedian">Comedian</option>
            <option value="juggler">Juggler</option>
        </select>
        <label class="label_1" for="description">Give a description of what you do<span class="error">* <?php echo $descriptionErr;?></label><br>
        <textarea name="description" id="description" placeholder="Description..."></textarea><br>
        <p>
            <input type="submit" name="submit" value="Submit">
        </p>
    </form>
    
    <form id="client_form" method="POST" action="request-events-process.php" enctype="multipart/form-data">
        <div class="vertical_line">
            <h1 class="for_client">For clients</h1>
            <label class="label_2" for="full_name_2">Full name:<span class="error">* <?php echo $fullName2Err;?></label><br>
            <input type="text" class="form_2" name="full_name_2" id="full_name_2" placeholder="Enter your full name here"><br>
            <label class="label_2" for="email_address_2">Email Address:<span class="error">* <?php echo $emailAddress2Err;?></label><br>
            <input type="email" class="form_2" name="email_address_2" id="email_address_2" placeholder="Enter your email address here"><br>
            <label class="label_2" for="name_of_event">Name of Event:<span class="error">* <?php echo $eventErr;?></label><br>
            <input type="text" class="form_2" name="name_of_event" id="name_of_event" placeholder="What is the name of event"><br>
            <label class="label_2" for="event_description">Description of event<span class="error">* <?php echo $eventDescriptionErr;?></label><br>
            <textarea class="textarea_1" name="event_description" id="event_description" placeholder="Describe the event..."></textarea><br>
            <p>
                <input class="submit_2" type="submit" name="submit_2" value="Submit">
            </p>
        </div>
    </form>

</div>
<?php
include "components/footer.php";
?>
