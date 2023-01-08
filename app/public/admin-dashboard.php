<?php
session_start();
global $dbHandler;
global $err_count_1;
global $email_delete;
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
                        $err_count_1 = 0;
                    }
                }
                ?>
        <form class="form_register" method="POST" action="admin-dashboard.php">
            <label for="name">First Name</label>
            <span>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST["submit"] == "Register talent") { // Registration of new talents
                        if (!$first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS)) {//Input verification
                            echo "<i class='error'>Enter a First Name!</i>";
                            $err_count_1++;
                        }
                    }
                }
                ?>
            </span> <span class="error">*</span><br>
            <input class="input_text" type="text" name="first_name" id="name" value="<?php if (isset($_POST['first_name'])){echo $_POST['first_name'];} ?>"><br>

            <label for="name">Last Name</label>
            <span>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST["submit"] == "Register talent") { // Registration of new talents
                        if (!$last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS)) {//Input verification
                            echo "<i class='error'>Enter a last Name!</i>";
                            $err_count_1++;
                        }
                    }
                }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="text" name="last_name" id="name" value="<?php if (isset($_POST['last_name'])){echo $_POST['last_name'];} ?>"><br>

            <label for="talent">Talent</label>
            <span>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST["submit"] == "Register talent") { // Registration of new talents
                        if (empty($talent_radio = filter_input(INPUT_POST, "talent", FILTER_SANITIZE_SPECIAL_CHARS))){//Input verification
                            echo "<i class='error'>Choose a talent!</i>";
                            $err_count_1++;
                        }
                    }
                }
                ?>
            </span><span class="error">*</span><br>
            <select class="radiob" name="talent" id="talent">
                <option disabled selected hidden=""></option>
                <option value="singer">Singer</option>
                <option value="dancer">Dancer</option>
                <option value="dj">DJ</option>
                <option value="magician">Magician</option>
                <option value="comedian">Comedian</option>
                <option value="juggler">Juggler</option>
            </select><br>

            <label for="email">Email</label>
            <span>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST["submit"] == "Register talent") { // Registration of new talents
                        if(!$email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL)){//Input verification
                            echo "<i class='error'>Enter a valid email!</i>";
                            $err_count_1++;
                        }
                        else{
                            try {
                                $query_1 = "SELECT id FROM talent WHERE email = :email"; //Checks if the email exists in the database
                                $stmt_1 = $dbHandler->prepare($query_1);
                                $stmt_1->bindParam(":email", $email);
                                $stmt_1->execute();
                                if($result = $stmt_1 -> fetchColumn()){
                                    echo "<i class='error'>This email is already in use!</i>";
                                    $err_count_1++;
                                }
                            }
                            catch (Exception $e){
                            }
                        }
                    }
                }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="email" name="email" id="email" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>"><br>

            <label for="password">Password</label>
            <span>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST["submit"] == "Register talent") { // Registration of new talents
                        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);//Input verification
                        if (strlen($password) < 8){
                            echo "<i class='error'>The password must be at least 8 characters long!</i>";
                            $err_count_1++;
                        }
                    }
                }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="password" name="password" id="password"><br>

            <label for="price">Price per hour (&euro;)</label>
            <span>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST["submit"] == "Register talent") { // Registration of new talents
                        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);//Input verification
                        if (!is_numeric($price)){
                            echo "<i class='error'>Value must be numeric!</i>";
                            $err_count_1++;
                        }
                        elseif (strlen($price) > 10000000){
                            echo "<i class='error'>The amount is too big, reduce it!</i>";
                            $err_count_1++;
                        }
                    }
                }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="number" name="price" id="price" value="<?php if (isset($_POST['price'])){echo $_POST['price'];} ?>"><br>

            <label for="description">Description</label>
            <span>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST["submit"] == "Register talent") { // Registration of new talents
                        if (!$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS)){//Input verification
                            echo "<i class='error'>Enter a Description!</i>";
                            $err_count_1++;
                        }
                    }
                }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="text" name="description" id="description" value="<?php if (isset($_POST['description'])){echo $_POST['description'];} ?>"><br>

            <span>
                <?php

                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    if ($_POST["submit"] == "Register talent"){ // Registration of new talents
                    $pass_hash = password_hash($password, PASSWORD_BCRYPT);
                    if ($err_count_1 === 0){
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
                            echo "<p class='success'><i>Talent registered successfully <span class='check'>&#10004;</span></i></p>";
                        }
                        catch (Exception $exc){
                        }
                    }
                    else {
                        echo "<p class='error'><i>Talent could not be registered</i></p>";
                    }
            }
        }
                ?>
            </span>
            <input type="submit" name="submit" value="Register talent">
        </form>

    </div>

    <div class="delete_talent">
        <h2>Delete talent</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if ($_POST["submit"] == "Remove"){
                $err_count = 0;
                }
            }
        ?>
        <form class="form_delete" method="POST" action="admin-dashboard.php">
            <label for="first_name_delete">First Name</label>
            <span>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if ($_POST["submit"] == "Remove") {
                                $query5 = "SELECT first_name FROM talent WHERE email = :email_delete";
                                $stmt_5 = $dbHandler->prepare($query5);
                                $stmt_5->bindParam("email_delete", $email_delete);
                                $stmt_5->execute();
                                $first_name_remove = $stmt_5->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($first_name_remove as $first_name_removed) {
                                    if (!$first_name_delete = filter_input(INPUT_POST, "first_name_delete", FILTER_SANITIZE_SPECIAL_CHARS)) {//Input verification
                                        echo "<i class='error'>Enter the first name of talent to delete</i>";
                                        $err_count++;
                                    } elseif ($first_name_delete != $first_name_removed) {
                                        echo "<i class='error'>Talent First name not found</i>";
                                        $err_count++;
                                    }
                                }
                            }
                        }
                        ?>
                    </span><span class="error">*</span>
            <br>
            <input class="input_text" type="text" name="first_name_delete" id="first_name_delete" value="<?php if (isset($_POST['first_name_delete'])){echo $_POST['first_name_delete'];} ?>"><br>

            <label for="last_name_delete">Last Name</label>
            <span>
                <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if ($_POST["submit"] == "Remove") {
                                $query6 = "SELECT last_name FROM talent WHERE email = :email_delete";
                                $stmt_6 = $dbHandler->prepare($query6);
                                $stmt_6->bindParam("email_delete", $email_delete);
                                $stmt_6->execute();
                                $last_name_remove = $stmt_6->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($last_name_remove as $last_name_removed) {
                                    if (!$last_name_delete = filter_input(INPUT_POST, "last_name_delete", FILTER_SANITIZE_SPECIAL_CHARS)) {//Input verification
                                        echo "<i class='error'>Enter the last name of talent to delete</i>";
                                        $err_count++;
                                    } elseif ($last_name_delete != $last_name_removed) {
                                        echo "<i class='error'>Talent last name not found</i>";
                                        $err_count++;
                                    }
                                }
                            }
                        }
                ?>
            </span><span class="error">*</span>
            <br>
            <input class="input_text" type="text" name="last_name_delete" id="last_name_delete" value="<?php if (isset($_POST['last_name_delete'])){echo $_POST['last_name_delete'];} ?>"><br>

            <label for="email_delete">Email</label>
            <span>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if ($_POST["submit"] == "Remove") {
                            if (!$email_delete = filter_input(INPUT_POST, "email_delete", FILTER_VALIDATE_EMAIL)){//Input verification
                                echo "<i class='error'>Enter the email address of talent to delete</i>";
                                $err_count++;
                            }
                        }
                    }

                ?>
            </span><span class="error">*</span>
            <br>
            <input class="input_text" type="email" name="email_delete" id="email_delete" value="<?php if (isset($_POST['email_delete'])){echo $_POST['email_delete'];} ?>"><br>
            <span>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    if ($_POST["submit"] == "Remove"){
                        $query_2 = "SELECT `id` FROM talent where `email` = :email_delete";
                        $stmt_2 = $dbHandler->prepare($query_2);
                        $stmt_2->bindParam("email_delete", $email_delete);
                        $stmt_2->execute();
                        $result = $stmt_2->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $results){
                            if ($err_count === 0){
                                try {
                                    $query_3 = "DELETE FROM talent where email = :email_delete";
                                    $stmt_3 = $dbHandler->prepare($query_3);
                                    $stmt_3->bindParam("email_delete", $email_delete);
                                    $stmt_3->execute();
                                    echo "<p class='success'><i>Talent deleted <span class='check'>&#10004;</span></i></p>";
                                }
                                catch (Exception $exc){
                                    echo "<p class='error'><i>Could not delete talent account</i></p>";
                                }
                            }
                            else{
                                echo "<p class='error'><i>Talent not found</i></p>";
                            }
                        }
                    }
                }
                ?>
            </span>
            <input type="submit" name="submit" value="Remove">
        </form>
    </div>

    <div class="add_admin">
        <h2>Register New Admin</h2>
        <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if($_POST["submit"]=="Register admin"){
                $err_count = 0;
            }
        }
        ?>
        <form class="form_delete" method="POST" action="admin-dashboard.php">
            <label for="first_name">First name</label>
            <span>
                <?php
                if($_SERVER["REQUEST_METHOD"]=="POST") {
                    if ($_POST["submit"] == "Register admin") {
                        if(!$firstName = filter_input(INPUT_POST,"firstName",FILTER_SANITIZE_FULL_SPECIAL_CHARS)){ #Input validation
                            echo "<i class='error'>Please enter a first name!</i>";
                            $err_count++;
                        }
                    }
                }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="text" name="firstName" id="first_name" value="<?php if (isset($_POST['firstName'])){echo $_POST['firstName'];} ?>"><br>

            <label for="last_name">Last name</label>
            <span>
                <?php
                if($_SERVER["REQUEST_METHOD"]=="POST") {
                    if ($_POST["submit"] == "Register admin") {
                        if(!$lastName = filter_input(INPUT_POST,"lastName",FILTER_SANITIZE_FULL_SPECIAL_CHARS)){//Input verification
                            echo "<i class='error'>Please enter a last name!</i>";
                            $err_count++;
                        }
                    }
                }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="text" name="lastName" id="last_name" value="<?php if (isset($_POST['lastName'])){echo $_POST['lastName'];} ?>"><br>

            <label for="email_register">Email</label>
            <span>
                <?php
                if($_SERVER["REQUEST_METHOD"]=="POST") {
                    if ($_POST["submit"] == "Register admin") {
                        if(!$email = filter_input(INPUT_POST,"email_admin",FILTER_VALIDATE_EMAIL)){//Input verification
                            echo "<i class='error'>Please enter a valid email!</i>";
                            $err_count++;
                        }
                        else{
                            try{ #If the email is already registered, returns an error
                                $stmt = $dbHandler -> prepare("SELECT user_id from User WHERE email=:email");
                                $stmt -> bindParam("email",$email);
                                $stmt -> execute();

                                if($result = $stmt -> fetchColumn()){
                                    echo "<i class='error'>This email is already in use!</i>";
                                    $err_count++;
                                }
                            }
                            catch(Exception $ex){
                                echo "<i class='error'>The following error occured: $ex</i>";
                                $err_count++;
                            }
                        }
                    }
                }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="email" name="email_admin" id="email_register" value="<?php if (isset($_POST['email_admin'])){echo $_POST['email_admin'];} ?>"><br>

            <label for="password_register">Password</label>
            <span>
                <?php
                if($_SERVER["REQUEST_METHOD"]=="POST") {
                    if ($_POST["submit"] == "Register admin") {
                        $pass = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);//Input verification
                        if(strlen($pass)<8){
                            echo "<i class='error'>The password must be at least 8 characters long!</i>";
                            $err_count++;
                        }
                    }
                }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="password" name="password" id="email_register"><br>
            <span>
            <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if($_POST["submit"]=="Register admin"){
                    $passHash = password_hash($pass,PASSWORD_BCRYPT);

                    if($err_count === 0){
                        try{
                            $stmt = $dbHandler ->
                            prepare("INSERT INTO `User` (`user_id`, `first_name`, `last_name`, `email`, `pass_hash`) VALUES (NULL, :firstName, :lastName, :email, :passHash)");
                            $stmt -> bindParam("firstName",$firstName);
                            $stmt -> bindParam("lastName",$lastName);
                            $stmt -> bindParam("email",$email);
                            $stmt -> bindParam("passHash",$passHash);
                            $stmt -> execute();
                            echo "<p class='success'><i>Admin registered successfully <span class='check'>&#10004;</span></i><p>";
                        }
                        catch(Exception $ex){
                            echo "<p class='error'><i>The following error occured: $ex</i></p>";
                        }
                    }
                    else{
                        echo "<p class='error'><i>There was a problem when registering the admin</i></p>";
                    }
                }
            }
            ?>
                </span>
            <input type="submit" name="submit" value="Register admin">
        </form>
    </div>
</div>

</body>
</html>

<?php
include "components/footer.php";
?>
