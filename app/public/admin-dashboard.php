<?php
    session_start();


    $cssFile = "admin-dashboard";
    $pageTitle = "admin-dashboard";

    if(!isset($_SESSION["aLogin"])){ #Redirects to log in if not logged in

        header("Location: admin-login.php");
    }
    if (isset($_SESSION['aLogin'])) {

        if (isset($_POST['log_out'])) {

            session_destroy();
            header("Location: admin-login.php");
        }

        if (isset($_POST['change_password'])) {

            header("Location: admin_change_password.php");
        }

        if (isset($_POST['talent_request'])) {

            header("Location: requests.php");
        }

        if (isset($_POST['add_event'])) {
            header("Location: manage-events.php");

        }
    }

    include "components/header.php";
    require "db_connection/connection.php";
?>

<?php

global $db;
global $err_count;
global $email_delete;

require __DIR__."/PHPMailer-master/src/PHPMailer.php";
require __DIR__."/PHPMailer-master/src/Exception.php";
require __DIR__."/PHPMailer-master/src/SMTP.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


?>


<div class="header">
    <h2>Admin Dashboard</h2>
</div>

<div class="info">
    <div class="photo">
        <img src="img/logo.png" alt="logo">
    </div>
    <h3>
        <?php
            $Admin_ID = $_SESSION['user_id'];//Shows the name of the current admin.
            $query = "SELECT * FROM User where user_id = ?";
            $stmt = $db->prepare($query);
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
                                $err_count++;
                            }
                        }
                    }
                ?>
            </span> <span class="error">*</span><br>
            <input class="input_text" type="text" name="first_name" id="name" value="<?php if ($err_count > 0){ if (isset($_POST['first_name'])){echo $_POST['first_name'];}} ?>"><br>

            <label for="name">Last Name</label>
            <span>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        if ($_POST["submit"] == "Register talent") { // Registration of new talents

                            if (!$last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS)) {//Input verification

                                echo "<i class='error'>Enter a last Name!</i>";
                                $err_count++;
                            }
                        }
                    }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="text" name="last_name" id="name" value="<?php if ($err_count > 0){ if (isset($_POST['last_name'])){echo $_POST['last_name'];}} ?>"><br>

            <label for="talent">Talent</label>
            <span>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        if ($_POST["submit"] == "Register talent") { // Registration of new talents

                            if (empty($talent_button = filter_input(INPUT_POST, "talent", FILTER_SANITIZE_SPECIAL_CHARS))){//Input verification

                                echo "<i class='error'>Choose a talent!</i>";
                                $err_count++;
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
                                $err_count++;
                            }
                            else{
                                try {

                                    $query_1 = "SELECT id FROM Talent WHERE email = :email"; //Checks if the email exists in the database
                                    $stmt_1 = $db->prepare($query_1);
                                    $stmt_1->bindParam(":email", $email);

                                    $stmt_1->execute();
                                    if($result = $stmt_1 -> fetchColumn()){

                                        echo "<i class='error'>This email is already in use!</i>";
                                        $err_count++;
                                    }
                                }
                                catch (PDOException $e){
                                }
                            }
                        }
                    }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="email" name="email" id="email" value="<?php if ($err_count > 0){ if (isset($_POST['email'])){echo $_POST['email'];}} ?>"><br>

            <label for="password">Password</label>
            <span>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        if ($_POST["submit"] == "Register talent") { // Registration of new talents

                            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);//Input verification

                        }
                    }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="password" name="password" id="password" value="<?php
            ?>" disabled><br>

            <label for="price">Price per hour (&euro;)</label>
            <span>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        if ($_POST["submit"] == "Register talent") { // Registration of new talents

                            $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);//Input verification

                            if (is_numeric((string)$price)){

                                if (strlen($price) > 6){

                                    echo "<i class='error'>The amount is too big, reduce it!</i>";
                                    $err_count++;
                                }
                            }
                            else{
                                echo "<i class='error'>Value must be numeric!</i>";
                                $err_count++;
                            }
                        }
                    }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="number" name="price" id="price" value="<?php if ($err_count > 0){ if (isset($_POST['price'])){echo $_POST['price'];}} ?>" min="0" max=""><br>

            <label for="description">Description</label>
            <span>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        if ($_POST["submit"] == "Register talent") { // Registration of new talents

                            if (!$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS)){//Input verification

                                echo "<i class='error'>Enter a Description!</i>";
                                $err_count++;
                            }
                        }
                    }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="text" name="description" id="description" value="<?php if ($err_count > 0){ if (isset($_POST['description'])){echo $_POST['description'];}} ?>"><br>

            <span>
                <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                        if ($_POST["submit"] == "Register talent"){ // Registration of new talents

                            if ($err_count === 0){

                                $pass_hash = password_hash($rand_pass, PASSWORD_BCRYPT);
                                $def_rating = 1;
                                $profile_url ="default.jpeg";

                                try {//Registers new talent if no error

                                    $query = "INSERT INTO Talent (`first_name`,`last_name`, `talent`, `email`, `password`, `rating` ,`description`, `price_per_hour`, `profilepic_url`) VALUES (:first_name,:last_name, :talent, :email, :pass_hash, :def_rating , :description, :price,:profile_url)";
                                    $stmt_1 = $db->prepare($query);

                                    $stmt_1->bindParam("first_name", $first_name);
                                    $stmt_1->bindParam("last_name", $last_name);
                                    $stmt_1->bindParam("talent", $talent_button);
                                    $stmt_1->bindParam("email", $email);
                                    $stmt_1->bindParam("pass_hash", $pass_hash);
                                    $stmt_1->bindParam("def_rating", $def_rating);
                                    $stmt_1->bindParam("description", $description);
                                    $stmt_1->bindParam("price", $price);
                                    $stmt_1->bindParam("profile_url", $profile_url);
                                    if ($db->affected_rows) {
                                        try{
                                            $passwords = $db->prepare("SELECT password FROM Talent WHERE email = :email");
                                            $passwords->bindParam(":email", $email);
                                            $passwords->execute();
                                            $password = $passwords->fetch();
                                            echo ("$password");
                                        }
                                        catch(Exception $ex){
                                            echo "$ex";
                                        }

                                        try {
                                            $mail = new PHPMailer();
                                            $mail->isSMTP();
                                            $mail->Host = 'smtp.gmail.com';
                                            $mail->Port = 587;
                                            $mail->SMTPAuth = true;
                                            $mail->Username = "e3tproject@gmail.com";
                                            $mail->Password = "kzwlwysxxrstdkue";
                                            $mail->Subject = "Your request to become one of our talents at E3T has been approved";
                                            $mail->CharSet = PHPMailer::CHARSET_UTF8;
                                            $mail->setFrom("e3tproject@gmail.com", "E3T");
                                            $mail->Body =
                                                "<p>Welcome to E3t " . $first_name . " " . $last_name . "</p>" .
                                                "<p><h2>You Request to become one of our talents at E3T has been approved. Below you will find your details as well as your password</h2></p>" .
                                                "<p>
                                    First name: <b>$first_name;</b><br>
                                    Last name: <b>$last_name;</b><br>
                                    Talent: <b>$talent_button;</b><br>
                                    Email address: <b>$email;</b><br>
                                    Password (Change this password as soon as possible): <b>root;</b><br>
                                    Description: <b>$description</b><br>
                                     </p>
                                     <p><a href='login.php'>Click this link to login</a></p>";
                                            $mail->isHTML();
                                            $mail->addAddress("$email", "$first_name.$last_name");
                                            $mail->send();
                                            $mail->smtpClose();
                                        } catch (Exception $e) {
                                            echo $e->getMessage();
                                        }
                                    }

                                    echo "<p class='success'><i>Talent registered successfully <span class='check'>&#10004;</span></i></p>";
                                }
                                catch (PDOException $exc){

                                    echo "Talent registration failed".$exc->getMessage();
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

                                    $query5 = "SELECT first_name FROM Talent WHERE email = :email_delete";
                                    $stmt_5 = $db->prepare($query5);
                                    $stmt_5->bindParam("email_delete", $email_delete);

                                    $stmt_5->execute();
                                    $first_name_remove = $stmt_5->fetchAll(PDO::FETCH_ASSOC);

                                    if (!$first_name_delete = filter_input(INPUT_POST, "first_name_delete", FILTER_SANITIZE_SPECIAL_CHARS)) {//Input verification

                                        echo "<i class='error'>Enter the first name of talent to delete</i>";
                                        $err_count++;
                                    }
                                    foreach ($first_name_remove as $first_name_removed) {

                                        if ($first_name_removed != $first_name_delete) {

                                            echo "<i class='error'>Talent First name not found</i>";
                                            $err_count++;
                                        }
                                    }
                                }
                            }
                        ?>
                    </span><span class="error">*</span>
            <br>
            <input class="input_text" type="text" name="first_name_delete" id="first_name_delete" value="<?php if ($err_count > 0){ if (isset($_POST['first_name_delete'])){echo $_POST['first_name_delete'];}} ?>"><br>

            <label for="last_name_delete">Last Name</label>
            <span>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        if ($_POST["submit"] == "Remove") {

                            $query6 = "SELECT last_name FROM Talent WHERE email = :email_delete";
                            $stmt_6 = $db->prepare($query6);
                            $stmt_6->bindParam("email_delete", $email_delete);

                            $stmt_6->execute();
                            $last_name_remove = $stmt_6->fetchAll(PDO::FETCH_ASSOC);

                            if (!$last_name_delete = filter_input(INPUT_POST, "last_name_delete", FILTER_SANITIZE_SPECIAL_CHARS)) {//Input verification

                                echo "<i class='error'>Enter the last name of talent to delete</i>";
                                $err_count++;
                            }
                            foreach ($last_name_remove as $last_name_removed) {

                                if ($last_name_delete != $last_name_removed) {

                                    echo "<i class='error'>Talent last name not found</i>";
                                    $err_count++;
                                }
                            }
                        }
                    }
                ?>
            </span><span class="error">*</span>
            <br>
            <input class="input_text" type="text" name="last_name_delete" id="last_name_delete" value="<?php if ($err_count > 0){ if (isset($_POST['last_name_delete'])){echo $_POST['last_name_delete'];}} ?>"><br>

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
            <input class="input_text" type="email" name="email_delete" id="email_delete" value="<?php if ($err_count > 0){ if (isset($_POST['email_delete'])){echo $_POST['email_delete'];}} ?>"><br>
            <span>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                        if ($_POST["submit"] == "Remove"){

                            $query_2 = "SELECT `id` FROM Talent where `email` = :email_delete";
                            $stmt_2 = $db->prepare($query_2);
                            $stmt_2->bindParam("email_delete", $email_delete);

                            $stmt_2->execute();
                            $result = $stmt_2->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($result as $results){

                                if ($err_count === 0){

                                    try {

                                        $query_3 = "DELETE FROM Talent where email = :email_delete";
                                        $stmt_3 = $db->prepare($query_3);
                                        $stmt_3->bindParam("email_delete", $email_delete);

                                        if ($stmt_3->execute()){
                                            try {
                                                $mail = new PHPMailer();
                                                $mail->isSMTP();
                                                $mail->Host = 'smtp.gmail.com';
                                                $mail->Port = 587;
                                                $mail->SMTPAuth = true;
                                                $mail->Username = "e3tproject@gmail.com";
                                                $mail->Password = "kzwlwysxxrstdkue";
                                                $mail->Subject = "Your E3t account has been terminated";
                                                $mail->CharSet = PHPMailer::CHARSET_UTF8;
                                                $mail->setFrom("e3tproject@gmail.com", "E3T");
                                                $mail->Body =
                                                    "<p>Goodbye " . $first_name_delete . " " . $last_name_delete . "</p>" .
                                                    "<p><h2>Your E3T account has been terminated</h2></p>" .
                                                    "<p>
                                                    We are sorry to inform you that your account with us at E3T has been terminated.
                                                    </p>
                                                    <p><a href='index.php'>Click this link to visit our page</a></p>";
                                                $mail->isHTML();
                                                $mail->addAddress("$email_delete", "$first_name_delete.$last_name_delete");
                                                $mail->send();
                                                $mail->smtpClose();
                                            } catch (Exception $e) {
                                                echo $e->getMessage();
                                            }
                                        }
                                        echo "<p class='success'><i>Talent deleted <span class='check'>&#10004;</span></i></p>";
                                    }
                                    catch (PDOException $exc){
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
            <input class="input_text" type="text" name="firstName" id="first_name" value="<?php if ($err_count > 0){ if (isset($_POST['firstName'])){echo $_POST['firstName'];}} ?>"><br>

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
            <input class="input_text" type="text" name="lastName" id="last_name" value="<?php if ($err_count > 0){ if (isset($_POST['lastName'])){echo $_POST['lastName'];}} ?>"><br>

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

                                    $stmt = $db -> prepare("SELECT user_id from User WHERE email=:email");
                                    $stmt -> bindParam("email",$email);

                                    $stmt -> execute();

                                    if($result = $stmt -> fetchColumn()){

                                        echo "<i class='error'>This email is already in use!</i>";
                                        $err_count++;
                                    }
                                }
                                catch(PDOException $ex){
                                    echo "<i class='error'>The following error occured: $ex</i>";
                                    $err_count++;
                                }
                            }
                        }
                    }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="email" name="email_admin" id="email_register" value="<?php if ($err_count > 0) {if (isset($_POST['email_admin'])){echo $_POST['email_admin'];}} ?>"><br>

            <label for="password_register">Password</label>
            <span>
                <?php
                    if($_SERVER["REQUEST_METHOD"]=="POST") {

                        if ($_POST["submit"] == "Register admin") {

                            $pass = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);//Input verification

                            }
                        }
                ?>
            </span><span class="error">*</span><br>
            <input class="input_text" type="password" name="password" id="password_register" value="<?php
            ?>" disabled><br>
            <span>
            <?php
                if($_SERVER["REQUEST_METHOD"]=="POST"){

                    if($_POST["submit"]=="Register admin"){

                        $passHash = password_hash($rand_pass_1,PASSWORD_BCRYPT);

                        if($err_count === 0){

                            try{

                                $stmt = $db ->
                                prepare("INSERT INTO `User` (`user_id`, `first_name`, `last_name`, `email`, `pass_hash`) VALUES (NULL, :firstName, :lastName, :email, :passHash)");

                                $stmt -> bindParam("firstName",$firstName);
                                $stmt -> bindParam("lastName",$lastName);
                                $stmt -> bindParam("email",$email);
                                $stmt -> bindParam("passHash",$passHash);

                                if ($stmt -> execute()){
                                    try {
                                        $mail = new PHPMailer();
                                        $mail->isSMTP();
                                        $mail->Host = 'smtp.gmail.com';
                                        $mail->Port = 587;
                                        $mail->SMTPAuth = true;
                                        $mail->Username = "e3tproject@gmail.com";
                                        $mail->Password = "kzwlwysxxrstdkue";
                                        $mail->Subject = "You have been chosen to become an admin at E3T";
                                        $mail->CharSet = PHPMailer::CHARSET_UTF8;
                                        $mail->setFrom("e3tproject@gmail.com", "E3T");
                                        $mail->Body =
                                            "<p>Welcome to E3t Admin " . $firstName . " " . $lastName . "</p>" .
                                            "<p><h2>You have been chosen to become an admin at E3T. Below you will find your details as well as your randomly generated password</h2></p>" .
                                            "<p>
                                    First name: <b>$firstName;</b><br>
                                    Last name: <b>$lastName;</b><br>
                                    Email address: <b>$email;</b><br>
                                    Password (Change this password as soon as possible): <b>$rand_pass_1;</b><br>
                                     </p>
                                     <p><a href='admin-login.php'>Click this link to login</a></p>";
                                        $mail->isHTML();
                                        $mail->addAddress("$email", "$firstName.$lastName");
                                        $mail->send();
                                        $mail->smtpClose();
                                    } catch (Exception $e) {
                                        echo $e->getMessage();
                                    }
                                }
                                echo "<p class='success'><i>Admin registered successfully <span class='check'>&#10004;</span></i><p>";
                            }
                            catch(PDOException $ex){
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
<div class="last_buttons">
    <form method="post" action="admin-dashboard.php">
        <input type="submit" name="add_event" value="ADD EVENTS">
        <input type="submit" name="talent_request" value="VIEW TALENT REQUEST">
        <input type="submit" name="change_password" value="CHANGE PASSWORD">
        <input class="logout" type="submit" name="log_out" value="LOG OUT">
    </form>
</div>

<?php
    include "components/footer.php";
?>
