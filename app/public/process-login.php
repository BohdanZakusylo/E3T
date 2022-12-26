<?php
session_start();
global $email_process;

//try{
//    $dbHandler = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","root","qwerty"); #Initialize DB connection
//}
//catch(Exception $err){
//    echo "<p class='error'>$err</p>";
//}
$host = 'localhost';
$user_name = 'root';
$dbname = 'e3t';
try {
    $dbHandler = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;", "$user_name", "emperor");
}
catch (Exception $e){
    echo "Unsuccessful Connection" . $e->getMessage();
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email_process = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL); #Get the email and password from the form
    $pass = filter_input(INPUT_POST,"password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    try{
        $stmt = $dbHandler -> prepare("SELECT Admin_id, Password FROM admin WHERE Email = :email"); #Tries to find email in DB
        $stmt -> bindParam("email",$email_process,PDO::PARAM_STR);
        $stmt -> execute();
        $queryResult = $stmt -> fetchAll();
        $user = $queryResult['FirstName'];
    }
    catch(Exception $err){
       echo "<p class='error'>$err</p>";
    }
    if($queryResult){  #Valid email
        $passHash = $queryResult[0][1]; #Password hash retrieved from DB
        if(password_verify($pass,$passHash)){ # Verifies user password against retrieved hash
            $_SESSION["aLogin"] = true;
            $_SESSION['users'] = $user;
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