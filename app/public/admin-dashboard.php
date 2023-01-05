<?php
session_start();
global $email_process;

$cssFile = "admin-dashboard";
$pageTitle = "admin-dashboard";

if(!isset($_SESSION["aLogin"])){ #Redirects to log in if not logged in
    header("Location: admin-login.php");
}

include "components/header.php";


try{
    $dbHandler = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","root","qwerty"); #Initialize DB connection
}
catch(Exception $ex){
    echo "<p class='error'>The following error occurred: $ex</p>";
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
                <img src="img/logo.png" alt="logo">
            </div>
            <h3>
                <?php
                $Admin_ID = $_COOKIE['user_id'];//Shows the name of the current admin.
                $query = "SELECT * FROM user where user_id = ?";
                $stmt = $dbHandler->prepare($query);
                $stmt -> bindparam(1, $Admin_ID, PDO::PARAM_INT);
                $stmt->execute();

                $res = $stmt -> fetch(PDO::FETCH_ASSOC);
                echo $res['first_name'] . " " . $res['last_name'];
                ?>
            </h3>
        </div>

        <div class="container">
                <div class="new_talents">
                    <h2>Register new talents</h2>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                        if ($_POST["submit"] == "Register talent"){ // Registration of new talents
                            $err_count = 0;
                            if (!$first_name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS)){//Input verification
                                echo "<p class='error'>Pls enter a First Name</p>";
                                $err_count++;
                            }

                            if (!$last_name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS)){//Input verification
                                echo "<p class='error'>Pls enter a Last Name</p>";
                                $err_count++;
                            }

                            if (empty($talent_radio = filter_input(INPUT_POST, "talent", FILTER_SANITIZE_SPECIAL_CHARS))){//Input verification
                                echo "<p class='error'>Pls choose a talent</p>";
                            }

                            if(!$email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL)){//Input verification
                                echo "<p class='error'>Please enter a valid email!</p>";
                                $err_count++;
                            }
                            else{
                                try {
                                    $query_1 = "SELECT id FROM talent WHERE email = :email"; //Checks if the email exists in the database
                                    $stmt_1 = $dbHandler->prepare($query_1);
                                    $stmt_1->bindParam(":email", $email);
                                    $stmt_1->execute();
                                    if($result = $stmt_1 -> fetchColumn()){
                                        echo "<p class='error'>This email is already in use!</p>";
                                        $err_count++;
                                    }
                                }
                                catch (Exception $e){
                                    echo "<p class='error'>Error, Please check your inputs</p>";
                                }
                            }

                            $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);//Input verification
                            if (!is_numeric($price)){
                                echo "<p class='error'>Value must be numeric</p>";
                                $err_count++;
                            }
                            elseif (strlen($price) > 100000){
                                echo "<p class='error'>The amount is too big, reduce it</p>";
                            }

                            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);//Input verification
                            if (strlen($password) < 8){
                                echo "<p class='error'>The password must be at least 8 characters long</p>";
                                $err_count++;
                            }
                            elseif (strlen($password) == 0){//Input verification
                                echo "<p>Please enter a password</p>";
                                $err_count++;
                            }

                            if (!$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS)){//Input verification
                                echo "<p class='error'>Pls enter a Description</p>";
                                $err_count++;
                            }

                            $pass_hash = password_hash($password, PASSWORD_BCRYPT);

                            if ($err_count === 0){
                                try {//Registers new talent if no error
                                    $query = "INSERT INTO talent (`first_name`,`last_name`, `talent`, `email`, `password`,`description`, `price_per_hour`) VALUES (:first_name,:last_name, :talent, :email, :pass_hash, :description, :price)";
                                    $stmt_1 = $dbHandler->prepare($query);
                                    $stmt_1->bindParam("first_name", $first_name);
                                    $stmt_1->bindParam("last_name", $last_name);
                                    $stmt_1->bindParam("talent", $talent_radio);
                                    $stmt_1->bindParam("email", $email);
                                    $stmt_1->bindParam("pass_hash", $pass_hash);
                                    $stmt_1->bindParam("description", $description);
                                    $stmt_1->bindParam("price", $price);
                                    $stmt_1->execute();
                                    echo "<p class='success'>Talent registered successfully</p>";
                                }
                                catch (Exception $exc){
                                }
                            }
                            else {
                                echo "<p class='error'>Talent could not be registered</p>";
                            }
                        }
                    }
                    ?>
                <form class="form_register" method="POST" action="admin-dashboard.php">
                    <label for="name">First Name</label><br>
                    <input class="input_text" type="text" name="name" id="name"><br>
                    <label for="name">Last Name</label><br>
                    <input class="input_text" type="text" name="name" id="name"><br>
                    <label for="talent">Talent</label><br>
                    <div class="radiob">
                        <input type="radio" name="talent" value="Singer" id="talent">Singer
                        <input type="radio" name="talent" value="Dancer" id="talent">Dancer
                        <input type="radio" name="talent" value="Actor" id="talent">Actor
                        <input type="radio" name="talent" value="Dj" id="talent">Dj
                        <input type="radio" name="talent" value="Magician" id="talent">Magician<br>
                        <input type="radio" name="talent" value="Comedian" id="talent">Comedian
                        <input type="radio" name="talent" value="Juggler" id="talent">Juggler<br>
                    </div>
                    <label for="email">Email</label><br>
                    <input class="input_text" type="email" name="email" id="email"><br>
                    <label for="password">Password</label><br>
                    <input class="input_text" type="password" name="password" id="password"><br>
                    <label for="price">Price per hour (&euro;)</label><br>
                    <input class="input_text" type="number" name="price" id="price"><br>
                    <label for="description">Description</label><br>
                    <input class="input_text" type="text" name="description" id="description"><br>
                    <input type="submit" name="submit" value="Register talent">
                </form>
            </div>

            <div class="delete_talent">
                <h2>Delete talent</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    if ($_POST["submit"] == "Remove"){
                        $err_count = 0;
                        if (!$name_delete = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS)){//Input verification
                            echo "<p class='error'>Enter the name of talent to delete</p>";
                        }
                        if (!$email_delete = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)){//Input verification
                            echo "<p class='error'>Enter the email address of talent to delete</p>";
                        }

                        $query_2 = "SELECT `id` FROM talent where `email` = :email_delete";
                        $stmt_2 = $dbHandler->prepare($query_2);
                        $stmt_2->bindParam("email_delete", $email_delete);
                        $stmt_2->execute();
                        $result = $stmt_2->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $results){
                            if ($_POST["submit"] = "Remove" == TRUE){
                                try {
                                    $query_3 = "DELETE FROM talent where email = :email_delete";
                                    $stmt_3 = $dbHandler->prepare($query_3);
                                    $stmt_3->bindParam("email_delete", $email_delete);
                                    $stmt_3->execute();
                                    echo "<p class='success'>Talent deleted</p>";
                                }
                                catch (Exception $exce){
                                    echo "<p class='error'>Could not delete talent account</p>";
                                }
                            }
                            else{
                                echo "<p class='error'>Talent not found</p>";
                            }
                        }
                    }
                }
                ?>
                <form class="form_delete" method="POST" action="admin-dashboard.php">
                    <label for="stage_name">Name/Stage name</label><br>
                    <input class="input_text" type="text" name="name" id="stage_name"><br>
                    <label for="email_delete">Email</label><br>
                    <input class="input_text" type="email" name="email" id="email_delete"><br>
                    <input type="submit" name="submit" value="Remove">
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

                        if(!$lastName = filter_input(INPUT_POST,"lastName",FILTER_SANITIZE_FULL_SPECIAL_CHARS)){//Input verification
                            echo "<p class='error'>Please enter a last name!</p>";
                            $errcount++;
                        }

                        if(!$email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL)){//Input verification
                            echo "<p class='error'>Please enter a valid email!</p>";
                            $errcount++;
                        }
                        else{
                            try{ #If the email is already registered, returns an error
                                $stmt = $dbHandler -> prepare("SELECT user_id from User WHERE email=:email");
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

                        $pass = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);//Input verification
                        if(strlen($pass)<8 OR strlen($pass)==0){
                            echo "<p class='error'>The password must be at least 8 characters long!</p>";
                            $errcount++;
                        }
                        $passHash = password_hash($pass,PASSWORD_BCRYPT);

                        if($errcount === 0){
                            try{
                                $stmt = $dbHandler ->
                                prepare("INSERT INTO `User` (`user_id`, `first_name`, `last_name`, `email`, `pass_hash`) VALUES (NULL, :firstName, :lastName, :email, :passHash)");
                                $stmt -> bindParam("firstName",$firstName,PDO::PARAM_STR);
                                $stmt -> bindParam("lastName",$lastName,PDO::PARAM_STR);
                                $stmt -> bindParam("email",$email,PDO::PARAM_STR);
                                $stmt -> bindParam("passHash",$passHash,PDO::PARAM_STR);
                                $stmt -> execute();
                                echo "<p class='success'>Admin registered successfully!<p>";
                            }
                            catch(Exception $ex){
                                echo "<p class='error'>The following error occured: $ex</p>";
                            }
                        }
                        else{
                            echo "<p class='error'>There was a problem when registering the admin</p>";
                        }
                    }
                }
                ?>
                <form class="form_delete" method="POST" action="admin-dashboard.php">
                    <label for="first_name">First name</label><br>
                    <input class="input_text" type="text" name="firstName" id="first_name"><br>
                    <label for="last_name">Last name</label><br>
                    <input class="input_text" type="text" name="lastName" id="last_name"><br>
                    <label for="email_register">Email</label><br>
                    <input class="input_text" type="email" name="email" id="email_register"><br>
                    <label for="password_register">Password</label><br>
                    <input class="input_text" type="password" name="password" id="email_register"><br>
                    <input type="submit" name="submit" value="Register admin">
                </form>
            </div>
        </div>

</body>
</html>

<?php
include "components/footer.php";
?>
