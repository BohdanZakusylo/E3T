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
?>

<main>
    <div id="admin">
        <form>
            <h1 class="admin_login">Admin Login</h1>
            <p>
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username"><br>
            </p>
            <p>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"><br>
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
