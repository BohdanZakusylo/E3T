<?php
session_start();
if(isset($_SESSION["aLogin"])){ #Redirects to dashboard if logged in
    header("Location: admin-dashboard.php");
}

$cssFile = "admin-login";
$pageTitle = "admin-login";
include "components/header.php";

try{
    $dbHandler = new PDO("mysql:host=mysql;dbname=Admin;charset=utf8","root","qwerty"); #Initialize DB connection
}
catch(Exception $err){
    echo "<p class='error'>$err</p>";
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $uname = filter_input(INPUT_POST,"username",FILTER_SANITIZE_FULL_SPECIAL_CHARS); #Get the username and password from the form
    $pass = filter_input(INPUT_POST,"password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    try{
        $stmt = $dbHandler -> prepare("SELECT id, passHash FROM admin WHERE username = :uname"); #Tries to find username in DB
        $stmt -> bindParam("uname",$uname,PDO::PARAM_STR);
        $stmt -> execute();
        $queryResult = $stmt -> fetchAll();
        
        if($queryResult){  #Valid username
            
            echo "Username match!";
        }
        else{  #Invalid username

            echo "Invalid username!";
        }

        $passHash = $queryResult[0][1]; #Password hash retrieved from DB

        if(password_verify($pass,$passHash)){ # Verifies user password against retrieved hash
            echo "Password match!";
        }
        else{
            echo "Invalid password!";
        }
    }
    catch(Exception $err){
        echo "<p class='error'>$err</p>";
    }

}
?>

<main>
    <div id="admin">
        <form method="POST" autocomplete="off">
            <h1 class="admin_login">Admin Login</h1>
            <p>
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>
            </p>
            <p>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br>
            </p>
            <p>
                <input type="submit" name="login" value="Login">
            </p>
        </form>
    </div>

    <div class="power">
        <p class="powered">
            Powered by E3T Technology
        </p>
    </div>
</main>

<?php
include "components/footer.php";
?>
