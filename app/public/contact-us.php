<?php
$cssFile = "contact-us";
$pageTitle = "contact-us";
include ("components/header.php");
?>
<main>
<div id="header_2">
    <h1 class="header_2_text">Contact Us</h1>
    <p class="header_text">Do you want E3T to host your events? or do are you a new talent that
        wants to join E3T?, kindly reach out to us using the contact forms below
    </p>
</div>
<form id="talent_form">
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

<form id="client_form">
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
</main>
<?php
include "components/footer.php";
?>
