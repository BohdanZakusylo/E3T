<?php
session_start();

$cssFile = "admin-login";
$pageTitle = "admin-login";
include "components/header.php";

?>

<main>
    <div id="admin">
        <form action="process-login.php" method="POST" autocomplete="off">
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
