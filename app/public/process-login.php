<?php
session_start();

include "db_connection/connection.php";

if($_SERVER["REQUEST_METHOD"]=="POST" AND $_GET["login"]==="admin"){
    $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL); #Get the email and password from the form
    $pass = filter_input(INPUT_POST,"password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    try{
        $stmt = $db -> prepare("SELECT user_id, pass_hash FROM user WHERE email = :email"); #Tries to find email in DB
        $stmt -> bindParam("email",$email,PDO::PARAM_STR);
        $stmt -> execute();
        $queryResult = $stmt -> fetchAll();
        
    }
    catch(Exception $err){
       echo "<p class='error'>$err</p>";
    }
    if($queryResult){  #Valid email
        $passHash = $queryResult[0][1]; #Password hash retrieved from DB

        if((password_verify($pass, $passHash))){ # Verifies user password against retrieved hash
            $_SESSION["aLogin"] = true;
            $_SESSION['user_id'] = $queryResult[0][0];
            header("Location: admin-dashboard.php");
        }
        else{
            header("Location: admin-login.php?error=PW"); #If pw is invalid, redirects to login page
        }
    }
    else{  #Invalid email

        header("Location: admin-login.php?error=EM");
    }


}
elseif($_SERVER["REQUEST_METHOD"]=="POST" AND $_GET["login"]==="talent"){

    $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL); #Get the email and password from the form
    $pass = filter_input(INPUT_POST,"password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    try{
        $stmt = $db -> prepare("SELECT id, password FROM Talent WHERE email = :email"); #Tries to find email in DB
        $stmt -> bindParam("email",$email,PDO::PARAM_STR);
        $stmt -> execute();
        $queryResult = $stmt -> fetchAll();
        
    }
    catch(Exception $err){
       echo "<p class='error'>$err</p>";
    }
    if($queryResult){  #Valid email
        $passHash = $queryResult[0][1]; #Password hash retrieved from DB

        if((password_verify($pass, $passHash))){ # Verifies user password against retrieved hash
            $_SESSION["tLogin"] = true;
            $_SESSION['id'] = $queryResult[0][0];
            header("Location: talent-dashboard.php");
        }
        else{
            header("Location:login.php?error=PW"); #If pw is invalid, redirects to login page
        }
    }
    else{  #Invalid email

        header("Location: login.php?error=EM");
    }
}
else{
    echo "Well this is not supposed to happen";
    header("Location: login.php");
}
?>