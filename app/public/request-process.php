<?php

session_start();
    if(!isset($_SESSION["aLogin"])){ #Redirects to log in if not logged in
        header("Location: admin-login.php");
    }

    include "db_connection/connection.php";
    if (!empty($_GET)){

        $pass_hash = password_hash("root",PASSWORD_BCRYPT);
        $outputs = $db->prepare("SELECT  first_name, last_name, talent, email, description FROM Requests WHERE request_id = :request_id");
        $outputs->bindParam(":request_id", $_GET["id"]);
        $outputs->execute();
        while($output = $outputs->fetch()) {
            $insert = $db->prepare("INSERT INTO Talent(description, email, first_name, last_name, password, price_per_hour, profilepic_url, rating, talent) 
            VALUES(:description, :email, :first_name, :last_name, :pass_hash, 50, '', 1, :talent)");
            $insert->bindParam(":description", $output["description"]);
            $insert->bindParam(":email", $output["email"]);
            $insert->bindParam(":first_name", $output["first_name"]);
            $insert->bindParam(":last_name", $output["last_name"]);
            $insert->bindParam(":pass_hash",$pass_hash, PDO::PARAM_STR);
            $insert->bindParam(":talent", $output["talent"]);
            $insert->execute();
            $delete = $db->prepare("DELETE FROM Requests WHERE request_id = :id");
            $delete->bindParam(":id", $_GET["id"]);
            $delete->execute();
        }
        header("Location: confirmation.php");
    }
    
?>