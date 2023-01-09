<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $full_name = filter_input(INPUT_POST, "full_name_2");
        $email_address = filter_input(INPUT_POST, "email_address_2", FILTER_VALIDATE_EMAIL);
        $name_of_event = filter_input(INPUT_POST, "name_of_event");
        $event_description = filter_input(INPUT_POST, "event_description");
        $full = explode(" ", $full_name);
        $first_name = $full[0];
        $last_name = $full[1];
    }

?>