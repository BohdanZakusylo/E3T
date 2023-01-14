<?php
session_start();


    require __DIR__."/PHPMailer-master/src/PHPMailer.php";
    require __DIR__."/PHPMailer-master/src/Exception.php";
    require __DIR__."/PHPMailer-master/src/SMTP.php";


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;




    $cssFile = "contact-us";
$pageTitle = "contact-us";
include ("components/header.php");
require "db_connection/connection.php";
?>

<div id="body">
    <div id="header_2">
        <h1 class="header_2_text">Contact Us</h1>
        <p class="header_text">Do you want E3T to host your events? Or are you a new talent that
            wants to join E3T? Kindly reach out to us using the contact forms below.
        </p>
    </div>
    <?php
     $fullNameErr = $emailAddressErr = $talentErr = $descriptionErr = "";
    ?>
    <?php
        global $err_count;
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $err_count = 0;
                    if(isset($_POST["submit"])){
                    $_SESSION['firstName'] = $firstName = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
                    $_SESSION['lastName'] = $lastName = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
                    $_SESSION['emailAddress'] = $emailAddress = filter_input(INPUT_POST, "email_address", FILTER_VALIDATE_EMAIL);
                    $_SESSION['talent'] = $talent = filter_input(INPUT_POST, "talent");
                    $_SESSION['description'] = $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                    if(empty($firstName) || empty($lastName) || empty($emailAddress) || empty($talent) || empty($description)){
                        echo  "<b hidden='hidden'>Please provide all necessary information</b>";
                        $err_count++;
                    }
                    else{
                        try {
                            $query_1 = "SELECT id FROM Talent WHERE email = :email"; //Checks if the email exists in the database
                            $stmt_1 = $db->prepare($query_1);
                            $stmt_1->bindParam("email", $emailAddress);
                            $stmt_1->execute();
                            if ($result = $stmt_1->fetchColumn()) {
                                echo "<p hidden='hidden'>Email is already in use</p>";
                                $err_count++;
                            }
                        }
                        catch (PDOException $e){
                        }
                    }

                    if ($err_count === 0) {
                            echo "<div class='message1'>";
                            echo "<h2>Thank you for contacting us!</h2><br>";
                            echo "<b>First Name:</b> ".$firstName."<br>";
                            echo "<b>Last Name:</b> ".$lastName."<br>";
                            echo "<b>E-mail:</b> ".$emailAddress."<br>";
                            echo "<b>Talent:</b> ".$talent."<br>";
                            echo "<b>Description:</b> ".$description."<br>";
                            echo "We will contact you as soon as possible via your E-mail Address.";
                            echo "</div>";

                            $input = $db->prepare("INSERT INTO Requests (first_name, last_name, email, talent, description) VALUES (:firstName, :lastName, :email, :talent, :description)");
                            $input->bindParam(':firstName', $firstName);
                            $input->bindParam(':lastName', $lastName);
                            $input->bindParam(':email', $emailAddress);
                            $input->bindParam(':talent', $talent);
                            $input->bindParam(':description', $description);
                            $input->execute();
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

                        if (!empty($fullName2) && !empty($emailAddress2) && !empty($event) && !empty($eventDescription)){
                            $mail = new PHPMailer();
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->Port = 587;
                            $mail->SMTPAuth = true;
                            $mail->Username = "e3tproject@gmail.com";
                            $mail->Password = "kzwlwysxxrstdkue";
                            $mail->Subject = "Event Request";
                            $mail->CharSet = PHPMailer::CHARSET_UTF8;
                            $mail->setFrom("e3tproject@gmail.com", "E3T");
                            $mail->isHTML();
                            $query = "SELECT first_name,last_name,email FROM User";
                            $stmt = $db->prepare($query);
                            $stmt->execute();
                            $mails = $stmt->fetchAll();
                            foreach ($mails as $received) {
                                $mail->Body =
                                    "<p><h2>Event Requested by Client</h2></p> " ."<p>Good day ".
                                    $received['first_name']." ". $received['last_name'] . ",</p>" .
                                    "<p>A client submitted an event request and the details are listed below, <b>Attend to the request as soon as possible;</b></p>" .
                                    "<p>Full name: <b>$fullName2</b><br>" .
                                    "Email address: <b>$emailAddress2</b><br>" .
                                    "Name of event: <b>$event</b><br>" .
                                    "Event description: <b>$eventDescription</b></p>" .
                                    "<p class='error_email'><i>Do not reply to this email as it was generated automatically, and you will not receive a reply if you do</i></p>";
                            }

                            foreach ($mails as $received){
                                try {
                                    $mail->addAddress($received['email'], $received['first_name']." ".$received['last_name']);
                                }catch (Exception $e){
                                }
                            }
                            try {
                                $mail->send();
                            }catch (Exception $e){
                                $mail->getSMTPInstance()->reset();
                            }
                            $mail->clearAddresses();
                            $mail->clearAttachments();

                        }


                    if(empty($fullName2)){
                        $fullName2Err = "Please provide all necessary information";
                    } elseif(!PHPMailer::validateAddress($emailAddress2) || empty($emailAddress2)) {
                        $emailAddress2Err = "Please provide all necessary information";
                    } elseif(empty($event)) {
                        $eventErr = "Please provide all necessary information";
                    } elseif(empty($eventDescription)) {
                        $eventDescriptionErr = "Please provide all necessary information";
                    } elseif(str_word_count($fullName2) < 1) {
                        $fullName2Err = "Your full name must contain at least 2 words";
                    } elseif(str_word_count($eventDescription) < 1){
                        $eventDescriptionErr = "Your event description needs to contain at least 5 words";
                    } elseif(strlen($event) < 1){
                        $eventErr = "Your event name needs to contain at least 3 characters";
                    }else {
                            echo "<div class='message2'>";
                            echo "<h2>Thank you for contacting us!</h2><br>";
                            echo "<b>Full Name:</b> ".$fullName2."<br>";
                            echo "<b>E-mail:</b> ".$emailAddress2."<br>";
                            echo "<b>Event:</b> ".$event."<br>";
                            echo "<b>Event description:</b> ".$eventDescription."<br>";
                            echo "We will contact you as soon as possible via your E-mail Address.";
                            echo "</div>";
                    }
                }
            }
    ?>
    <form id="talent_form" method="POST" action="contact-us.php" enctype="multipart/form-data">
        <h1 class="for_talent">For talents</h1>
        <label class="label_1" for="first_name">First name:<span class="error">* <?php if (isset($_POST['first_name'])){
            if (empty($firstName)){
                echo "Please provide all necessary information";
                $err_count++;
            }
                }
            ?></span></label><br>
        <input type="text" name="first_name" id="full_name" placeholder="Enter your first name here"><br>
        <label class="label_1" for="last_name">Last Name:<span class="error">* <?php if (isset($_POST['last_name'])){
                    if(empty($lastName)){
                        echo  "Please provide all necessary information";
                        $err_count++;
                    }
                }
            ?></span></label><br>
        <input type="text" name="last_name" id="full_name" placeholder="Enter your last name here"><br>
        <label class="label_1" for="email_address">Email Address:<span class="error">* <?php if (isset($_POST['email_address'])){
                    if(empty($emailAddress)) {
                        echo "Please provide all necessary information";
                        $err_count++;
                    }
                    else{
                        try {
                            $query_1 = "SELECT id FROM Talent WHERE email = :email"; //Checks if the email exists in the database
                            $stmt_1 = $db->prepare($query_1);
                            $stmt_1->bindParam("email", $emailAddress);
                            $stmt_1->execute();
                            if ($result = $stmt_1->fetchColumn()) {
                                echo "Email is already in use";
                                $err_count++;
                            }
                        }
                        catch (PDOException $e){
                        }
                    }
                }
                ?></span></label><br>
        <input type="email" name="email_address" id="email_address" placeholder="Enter your email address here"><br>
        <label class="label_1" for="talent">Talent<span class="error">* <?php if (isset($_POST['talent'])){
                    if(empty($talent)) {
                        echo "Please provide all necessary information";
                        $err_count++;
                    }
                }
        ?></span></label><br>
        <select id="talent" name="talent">
            <option value="default" selected disabled>Choose your talent</option>
            <option value="Singer">Singer</option>
            <option value="Dancer">Dancer</option>
            <option value="Actor">Actor</option>
            <option value="DJ">DJ</option>
            <option value="Magician">Magician</option>
            <option value="Comedian">Comedian</option>
            <option value="Juggler">Juggler</option>
        </select>
        <label class="label_1" for="description">Give a description of what you do<span class="error">* <?php  if
                (isset($_POST['description'])){
                if(empty($description)) {
                    echo "Please provide all necessary information";
                    $err_count++;
                }
                elseif(str_word_count($description) < 1) {
                    echo "Your description must contain at least 1 words";
                    $err_count++;
                }
            }
            ?></label><br>
        <textarea name="description" id="description" placeholder="Description..."></textarea>
        <p>
            <input type="submit" name="submit" value="Submit">
        </p>
    </form>
    
    <form id="client_form" method="POST" action="" enctype="multipart/form-data">
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
