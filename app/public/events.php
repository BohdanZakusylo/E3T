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
include "calendar/html/calend.php";

//calendar code for us
    $outputs = $db->prepare("SELECT * FROM Events");
    $outputs->execute();
    $output = $outputs->fetchAll();
    var_dump($output);
    echo count($output)."<br>";

    foreach ($output as $value){
        echo "hello<br>";
        $calendar->addEvent(date('Y-12-14'), date('Y-12-14'), 'My Birthday', true);
    }

?>
<?php
    include "./components/footer.php";
?>