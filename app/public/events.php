<?php
    try {
        $db = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","root", "qwerty");
    }
    catch (Exception $ex){
        echo "$ex";
    }
?>
<?php
    $cssFile = "events";
    $pageTitle = "Events";
    include "./components/header.php";
?>
<?php
require('calendar/src/phpCalendar/Calendar.php');

use benhall14\phpCalendar\Calendar;

$calendar = new Calendar();

//calendar code for us
    $outputs = $db->prepare("SELECT * FROM Events");
    $outputs->execute();
    date_default_timezone_set('Europe/Amsterdam');
    $real_date = date('Y-m-d');
    while ($output = $outputs->fetch()){
        if ($output["end_date"]<$real_date){
            $events = $db->prepare("DELETE FROM Events WHERE `Events`.`event_id` = :id");
            $events->bindParam(":id", $output["event_id"]);
            $events->execute();
            while($event = $events->fetch()){
                $calendar->addEvent(date($event["start_date"]), date($event["end_date"]), $event["event_description"], true);
            }
        }
        else {
            $calendar->addEvent(date($output["start_date"]), date($output["end_date"]), $output["event_description"], true);
        }
    }
    #TODO also I can make the redirect to another page by adding in $calendar .= <a></a>
    //adding the events
    //$calendar->addEvent(date('Y-12-14'), date('Y-12-15'), 'My Birthday', true);
    include "calendar/html/calend.php";
?>
<?php
    include "./components/footer.php";
?>