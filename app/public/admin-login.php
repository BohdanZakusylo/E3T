<?php
session_start();

// if(isset($_SESSION["aLogin"])){ #Redirects to dashboard if logged in
//     header("Location: admin-dashboard.php");
// }
$cssFile = "admin-login";
$pageTitle = "admin-login";


try{
    $dbHandler = new PDO("mysql:host=mysql;dbname=Admin;charset=utf8","root","qwerty"); #Initialize DB connection
}
catch(Exception $err){
    echo "<p class='error'>$err</p>";
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL); #Get the email and password from the form
    $pass = filter_input(INPUT_POST,"password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    try{
        $stmt = $dbHandler -> prepare("SELECT id, passHash FROM admin WHERE email = :email"); #Tries to find email in DB
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
            #echo "Password match!";
            $_SESSION["aLogin"] = true;
            header("Location: admin-dashboard.php");
        }
        else{
            echo "Invalid password!";
        }
    }
    else{  #Invalid email

        echo "Invalid email!";
    }


}
include "components/header.php";
?>

<main>
    <div id="admin">
        <form action="admin-login.php" method="POST" autocomplete="off">
            <h1 class="admin_login">Admin Login</h1>
            <p>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>
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
