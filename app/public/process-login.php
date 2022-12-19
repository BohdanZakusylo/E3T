<?php
session_start();

try{
    $dbHandler = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","root","qwerty"); #Initialize DB connection
}
catch(Exception $err){
    echo "<p class='error'>$err</p>";
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL); #Get the email and password from the form
    $pass = filter_input(INPUT_POST,"password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    try{
        $stmt = $dbHandler -> prepare("SELECT user_id, pass_hash FROM User WHERE email = :email"); #Tries to find email in DB
        $stmt -> bindParam("email",$email,PDO::PARAM_STR);
        $stmt -> execute();
        $queryResult = $stmt -> fetchAll();
        
    }
    catch(Exception $err){
       echo "<p class='error'>$err</p>";
    }
    if($queryResult){  #Valid email
        $passHash = $queryResult[0][1]; #Password hash retrieved from DB

        if(password_verify($pass,$passHash)){ # Verifies user password against retrieved hash
            $_SESSION["aLogin"] = true;
            header("Location: admin-dashboard.php");
        }
        else{
            header("Location: admin-dashboard.php?error=PW"); #If pw is invalid, redirects to login page
        }
    }
    else{  #Invalid email

        header("Location: admin-dashboard.php?error=EM");
    }


}
?>