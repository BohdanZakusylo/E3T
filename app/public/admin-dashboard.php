<?php
session_start();

$cssFile = "admin-dashboard";
$pageTitle = "admin-dashboard";

if(!isset($_SESSION["aLogin"])){ #Redirects to login if not logged in
    header("Location: admin-login.php");
}

include "components/header.php";

try{
    $dbHandler = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","root","qwerty"); #Initialize DB connection
}
catch(Exception $ex){
    echo "<p class='error'>The following error occured: $ex</p>";
}


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
                <form class="form_register" method="POST" action="admin-dashboard.php">
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
                    <input type="submit" name="submit" value="Register talent">
                </form>
            </div>

            <div class="delete_talent">
                <h2>Delete talent</h2>
                <form class="form_delete" method="POST" action="admin-dashboard.php">
                    <label>Name/Stage name</label><br>
                    <input class="input_text" type="text" name="name"><br>
                    <label>Email</label><br>
                    <input class="input_text" type="email" name="email"><br>
                    <button>Remove</button>
                    <input type="submit" name="submit" value="Delete talent">
                </form>
            </div>

            <div class="delete_talent">
                <h2>Register New Admin</h2>
                <?php 
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    if($_POST["submit"]=="Register admin"){
                
                        $errcount = 0; 
                
                        if(!$firstName = filter_input(INPUT_POST,"firstName",FILTER_SANITIZE_FULL_SPECIAL_CHARS)){ #Input validation
                            echo "<p class='error'>Please enter a first name!</p>";
                            $errcount++;
                        }
                   
                        if(!$lastName = filter_input(INPUT_POST,"lastName",FILTER_SANITIZE_FULL_SPECIAL_CHARS)){
                            echo "<p class='error'>Please enter a last name!</p>";
                            $errcount++;
                        }
                
                        if(!$email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL)){
                            echo "<p class='error'>Please enter a valid email!</p>";
                            $errcount++;
                        }
                        else{
                            try{ #If the email is already registered, returns an error
                                $stmt = $dbHandler -> prepare("SELECT Admin_id from Admin WHERE Email=:email");
                                $stmt -> bindParam("email",$email,PDO::PARAM_STR);
                                $stmt -> execute();
                
                                if($result = $stmt -> fetchColumn()){
                                    echo "<p class='error'>This email is already in use!</p>";
                                    $errcount++;
                                }
                            }
                            catch(Exception $ex){
                                echo "<p class='error'>The following error occured: $ex</p>";
                                $errcount++;
                            }
                        }
                
                        $pass = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
                        if(strlen($pass)<8 OR strlen($pass)==0){
                            echo "<p class='error'>The password must be at least 8 characters long!</p>";
                            $errcount++;
                        }
                        $passHash = password_hash($pass,PASSWORD_BCRYPT);
                
                        if($errcount === 0){
                            try{
                                $stmt = $dbHandler -> 
                                prepare("INSERT INTO `Admin` (`Admin_ID`, `FirstName`, `LastName`, `Email`, `Password`) VALUES (NULL, :firstName, :lastName, :email, :passHash)");
                                $stmt -> bindParam("firstName",$firstName,PDO::PARAM_STR);
                                $stmt -> bindParam("lastName",$lastName,PDO::PARAM_STR);
                                $stmt -> bindParam("email",$email,PDO::PARAM_STR);
                                $stmt -> bindParam("passHash",$passHash,PDO::PARAM_STR);
                                $stmt -> execute();
                                echo "<p>Admin registered sucessfully!<p>";
                            }
                            catch(Exception $ex){
                                echo "<p class='error'>The following error occured: $ex</p>";
                            }
                        }
                    
                    }
                }
                ?>
                <form class="form_delete" method="POST" action="admin-dashboard.php">
                    <label>First name</label><br>
                    <input class="input_text" type="text" name="firstName"><br>
                    <label>Last name</label><br>
                    <input class="input_text" type="text" name="lastName"><br>
                    <label>Email</label><br>
                    <input class="input_text" type="email" name="email"><br>
                    <label>Password</label><br>
                    <input class="input_text" type="password" name="password"><br>
                    <button>Register</button>
                    <input type="submit" name="submit" value="Register admin">
                </form>
            </div>
        </div>

</body>
</html>

<?php
include "components/footer.php";
?>
