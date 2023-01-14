<?php
try{
    $db = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","server","fVGq7i5L"); #Initialize DB connection
}
catch(Exception $ex){
    echo "<p class='error'>The following error occured: $ex</p>";
}
?>