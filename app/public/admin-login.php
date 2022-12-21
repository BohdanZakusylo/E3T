<?php
$cssFile = "admin-login";
$pageTitle = "admin-login";
include "components/header.php";
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
