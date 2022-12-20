<?php
$cssFile = "login";
$pageTitle = "login";
include "components/header.php";
?>

<main>
    <div id="normal_login">
        <form>
            <h1 class="login">Login</h1>
            <p>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email"><br>
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
