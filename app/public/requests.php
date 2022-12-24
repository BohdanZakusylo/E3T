<?php
    $cssFile = "requests";
    $pageTitle = "Requests";
    include "components/header.php";
    include "db_connection/connection.php";
?>

<?php
    $outputs = $db->prepare("SELECT first_name, last_name, email, description FROM Requests");
    $outputs->execute();
    while($output = $outputs->fetch()){
        var_dump($output);
    }
?>

<?php
    include "components/footer.php";
?>