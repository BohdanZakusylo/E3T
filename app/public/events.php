<?php

require "db_connection/connection.php";

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
                $id = $event["event_id"];
                $link_to_event = "<a href='event-info.php?id=$id'>".$event['description']."</a>";
                $calendar->addEvent(date($event["start_date"]), date($event["end_date"]), $link_to_event, true);
            }
        }
        else {
            $id = $output["event_id"];
            $link_to_event = "<a href='event-info.php?id=$id'>".$output['name']."</a>";
            $calendar->addEvent(date($output["start_date"]), date($output["end_date"]), $link_to_event, true);
        }
    }

    include "calendar/html/calend.php";
?>
<?php
    include "./components/footer.php";
?>