<?php
$cssFile = "admin-dashboard";
$pageTitle = "admin-dashboard";


if(!isset($_SESSION["aLogin"])){ #Redirects to login if not logged in
    header("Location: admin-login.php");
}
include "components/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>   
        <div class="header">
            <h2>Admin Dashboard</h2>
        </div>

        <div class="info">
            <div class="photo">
                <img src="img/logo.png">
            </div>
            <h3>Naga</h3>
        </div>

        <div class="container">            
                <div class="new_talents">
                    <h2>Register new talents</h2>    
                <form class="form_register">
                    <label>Name/Stage name</label><br>
                    <input class="input_text" type="text" name="name"><br>
                    <label>Talent</label><br>
                    <div class="radiob">
                        <input type="radio" name="talent" value="Singer">Singer
                        <input type="radio" name="talent" value="Dancer">Dancer
                        <input type="radio" name="talent" value="Actor">Actor
                        <input type="radio" name="talent" value="Dj">Dj
                        <input type="radio" name="talent" value="Magician">Magician<br>
                        <input type="radio" name="talent" value="Comedian">Comedian
                        <input type="radio" name="talent" value="Juggler">Juggler<br>
                    </div>
                    <label>Email</label><br>
                    <input class="input_text" type="email" name="email"><br>
                    <label>Password</label><br>
                    <input class="input_text" type="password" name="password"><br>
                    <label>Price in Euro</label><br>
                    <input class="input_text" type="text" name="price"><br>
                    <button>Register</button>
                </form>
            </div>

            <div class="delete_talent">
                <h2>Delete talent</h2>
                <form class="form_delete">
                    <label>Name/Stage name</label><br>
                    <input class="input_text" type="text" name="name"><br>
                    <label>Email</label><br>
                    <input class="input_text" type="email" name="email"><br>
                    <button>Remove</button>
                </form>
            </div>
        </div>

</body>
</html>

<?php
include "components/footer.php";
?>
