<?php
$cssFile = "event-info";
$pageTitle = "Event info";
include "./components/header.php";
?>

<?php
try {
    $db = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","root", "qwerty");
}
catch (Exception $ex){
    echo "$ex";
}

if (!empty($_GET["id"])){
    try {
        $outputs = $db->prepare("SELECT * FROM Events WHERE event_id = :id");
        $outputs->bindParam(":id", $_GET["id"]);
        $outputs->execute();
        while($output = $outputs->fetch()){
            echo "<main>";
            echo "<div class='message1'>";
            echo "<b>Name of the event:</b> ".$output['name']."<br>";
            echo "<b>Event start on: </b> ".$output['start_date']."<br>";
            echo "<b>Event ends on: </b> ".$output['end_date']."<br>";
            echo "<b>Time: </b> ".$output['time']."<br>";
            echo "<b>Event take place in: </b> ".$output['place']."<br>";
            echo "<b>Description: </b> ".$output['event_description']."<br>";

             if (!empty($output['talent_id'])) {
                $id = $output['talent_id'];
                $query = "SELECT * FROM Talent WHERE id = ?";
                $stmt=$db->prepare($query);
                $stmt->bindparam(1, $id, PDO::PARAM_INT);
                $stmt->execute();
                $value = $stmt->fetch();

                if($value) {
                    echo "<b>Performing Talent: </b> ".$value['first_name']. " " .$value['last_name']."<br>";
                } else {
                    echo "Couldn't fetch from the DB";
                }
            }

            echo "<br>";
            echo "<a href='events.php'><button>Go Back</button></a>";
            echo "</div>";
            echo "</main>";
        }
    }
    catch (Exception $ex){
        echo "The id is invalid, try again later";
        die();
    }

}
else{
    echo "The page is invalid, try again later";
}

?>

<?php
include "./components/footer.php";
?>