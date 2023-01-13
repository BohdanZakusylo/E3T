<?php
    session_start();
    $cssFile = "login";
    $pageTitle = "login";
    include "components/header.php";
?>
<main>

    <div id="normal_login">

        <form action="process-login.php?login=talent" method="POST">
            <h1 class="login">Login</h1>

            <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "EM") {
                        echo "<p class='error'>Invalid credentials!</p>";
                    }
                    if ($_GET["error"] == "PW") {
                        echo "<p class='error'>Invalid credentials!</p>";
                    }
                }
            ?>

            <p>

                <label for="email" class="email">Email:</label><br>
                <input type="email" id="email" name="email"><br>

            </p>
            <p>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"><br>

            </p>
            <p id="login_p">

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
