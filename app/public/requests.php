<?php

    if(!isset($_SESSION["aLogin"])){ #Redirects to log in if not logged in
        header("Location: admin-login.php");
    }
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
    while ($output = $outputs->fetch()) {
        $first_name = $output["first_name"];
        $last_name = $output["last_name"];
        $talent = $output["talent"];
        $email = $output["email"];
        $description = $output["description"];
        $requset_id = $output["request_id"];
        echo "
            <div class='request'>
                <div id='all'>
                    <div class='divs'>
                        <p>First Name: $first_name</p>
                    </div>
                    <div class='divs'>    
                        <p>Last Name: $last_name</p>
                    </div>
                    <div class='divs'>    
                        <p>Email Address: $email</p>
                    </div>
                    <div class='divs'>
                        <p>Talent: $talent</p>
                    </div>
                    <div class='divs'>
                        <p>Description: $description</p>
                    </div>    
                    <div id='li'>
                        <a href='requests.php?id=$requset_id'><button>Decline</button></a>
                        <a href='request-process.php?id=$requset_id'><button>Accept</button></a>
                    </div>
                </div>
            </div> 
            <hr>   
        ";
    }
}
?>

<?php
    include "components/footer.php";
?>
