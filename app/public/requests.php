<?php
    $cssFile = "requests";
    $pageTitle = "Requests";
    include "components/header.php";
    include "db_connection/connection.php";
?>

<?php
    $outputs = $db->prepare("SELECT request_id, first_name, last_name, talent, email, description FROM Requests");
    $outputs->execute();
    while($output = $outputs->fetch()){
        $first_name = $output["first_name"];
        $last_name = $output["last_name"];
        $talent = $output["talent"];
        $email = $output["email"];
        $description = $output["description"];
        $requset_id = $output["request_id"];
        echo "<form action='request-process.php?id=".$requset_id."'>";
        echo "<div class='request'>";
        echo "<p>".$first_name." ".$last_name."</p>";
        echo "<p>".$talent."</p>";
        echo "<p>".$email."</p>";
        echo "<p>".$description."</p>";
        echo "<input type='submit' name='accept' value='Accept'>";
        echo "<input type='submit' name='decline' value='Decline'>";
        echo "</div>";
        echo "</form>";
    }
?>

<?php
    include "components/footer.php";
?>