<?php
try{
    $db = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","root","qwerty"); #Initialize DB connection
}
catch(Exception $ex){
    echo "<p class='error'>The following error occured: $ex</p>";
}
?>