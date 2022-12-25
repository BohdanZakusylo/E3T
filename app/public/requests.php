<?php
    $cssFile = "requests";
    $pageTitle = "Requests";
    include "components/header.php";
    include "db_connection/connection.php";
?>

<?php
if (!empty($_GET)){
    $id = $_GET["id"];
    $delete = $db->prepare("DELETE FROM Requests WHERE request_id = :id");
    $delete->bindParam(":id", $id);
    $delete->execute();
}
else {
    $outputs = $db->prepare("SELECT request_id, first_name, last_name, talent, email, description FROM Requests");
    $outputs->execute();
    $requset_id = 0;
    while ($output = $outputs->fetch()) {
        $first_name = $output["first_name"];
        $last_name = $output["last_name"];
        $talent = $output["talent"];
        $email = $output["email"];
        $description = $output["description"];
        $requset_id = $output["request_id"];
        echo "$requset_id";
        echo "
            <div class='request'>
            <p>" . $first_name . " " . $last_name . "</p>
            <p>" . $talent . "</p>
            <p>" . $email . "</p>
            <p>" . $description . "</p>
            <a href='requests.php?id=$requset_id'><button>Decline</button></a>
            <a href='request-process.php?id=$requset_id'><button>Accept</button></a>
            </div>
        ";
        // $requset_id++;
    }
}
?>

<?php
    include "components/footer.php";
?>