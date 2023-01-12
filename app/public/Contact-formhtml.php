<?php
    require "db_connection/connection.php";
?>

<!Doctype html>
<html lang="en">
<head>
    <title>Book event</title>
</head>
<body>
<h2>Event requested by Client</h2>
<p>
    <span>
        <?php
            date_default_timezone_set('Europe/Amsterdam');
            $time = date('H');
            $timezone = date("e");
            if ($time < '12'){
                echo 'Good morning ';
            }
            elseif ($time >= '12' && $time <= '16') {
                echo 'Good afternoon ';
            }
            elseif ($time >= '16' && $time < '24') {
                echo 'Good evening ';
            }
            $query = "SELECT first_name,last_name,email FROM User";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $mails = $stmt->fetchAll();
            foreach ($mails as $received){
                echo $received['first_name'] ." ". $received['last_name'];
            }
        ?>
    </span>
</p>
<p>A client submitted an event request and the details are listed below, Attend to the request as soon as possible</p>"
<p>
    Full name: <b><?= $fullName2 ?></b><br>
    Email address: <b><?= $emailAddress2 ?></b><br>
    Name of event: <b><?= $event ?></b><br>
    Event description: <b><?= $eventDescription ?></b>
</p>
<p class='error_email'><i>Do not reply to this email as it was generated automatically, and you will not receive a reply if you do</i></p>

</body>
</html>
