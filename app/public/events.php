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
    $output = $outputs->fetchAll();
    var_dump($output);
    echo count($output)."<br>";


    //adding the events
    //$calendar->addEvent(date('Y-12-14'), date('Y-12-15'), 'My Birthday', true);
    include "calendar/html/calend.php";
?>
<?php
    include "./components/footer.php";
?>