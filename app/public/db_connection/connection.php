<?php
try{
    $db = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","root","password1234"); #Initialize DB connection
}
catch(Exception $ex){
    echo "<p class='error'>The following error occured: $ex</p>";
}
?>