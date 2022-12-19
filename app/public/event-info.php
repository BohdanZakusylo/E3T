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
include "./components/footer.php";
?>