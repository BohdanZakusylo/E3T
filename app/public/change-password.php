<?php
 session_start();
$cssFile = "change-password";
$pageTitle = "Change Password";

if(!isset($_SESSION['tLogin'])) {
    header("Location: login.php");
}

include("components/header.php");

$talent_id = $_SESSION['id'];

?>

<main>

<section class="container">
    <form method="POST" action="">
    <div class="headcon">
    <h3>Change your Password</h3>
</div>
<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $currentpassword = filter_input(INPUT_POST, "currentpassword");
    $newpassword = filter_input(INPUT_POST, "newpassword");
    $re_newpassword = filter_input(INPUT_POST, "re-newpassword");

    if(!empty($newpassword) && !empty($re_newpassword)) {


    require_once("db_connection/connection.php");
    $query = "SELECT * from Talent WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bindparam(1, $talent_id, PDO::PARAM_INT);
    $stmt->execute();

    $value = $stmt->fetch(PDO::FETCH_ASSOC);

    if($value) {
        $dbpassword = $value['password'];

        if(password_verify($currentpassword, $dbpassword)) {
                if ($newpassword == $re_newpassword) {
                        if(strlen($newpassword) > 7) {
                            if(!ctype_lower($newpassword) && !ctype_upper($newpassword)) {
                                if(preg_match('@[0-9]@', $newpassword)) {
                                    if(!is_numeric($newpassword)) {

                                        $pass_hash = password_hash($newpassword, PASSWORD_BCRYPT);


                                        $query = "UPDATE Talent SET password = ? WHERE id=?";
                                        $stmt=$db->prepare($query);
                                        $stmt->bindparam(1, $pass_hash);
                                        $stmt->bindparam(2, $talent_id, PDO::PARAM_INT);
                                        $update = $stmt->execute();
                                        
                                        if ($update) {
                                            echo "<p class='noerror'>Your password has been updated</p>";
                                        }

                                    } else {
                                        echo "<p class='error'>Password must contain a Lower and Upper case alphabet and Number</p>"; 
                                    }

                                }else {
                                    echo "<p class='error'>Password must contain a Lower and Upper case alphabet and Number</p>";  
                                }
                            } else {
                                echo "<p class='error'>Password must contain a Lower and Upper case alphabet and Number</p>";
                            }

                        } else {
                            echo "<p class='error'>Passowrd is too short, it must be a minimum of 8 charachers</p>";
                        }
                } else {
                    echo "<p class='error'>New Password do not match</p>";
                }

        } else {
            echo "<p class='error'>current password is incorrect</p>";
        }

    } else {
        echo "<p class='error'>Couldn't fetch your information from the database</p>";
    }
} else {
    echo "Password fields cannot be empty";
}
}


?>

<div>
    <label for="currentpassword">Current Password: </label>
    <input name="currentpassword" type="password" class="form-field"placeholder="Type your current password here" required>
</div>

<div>
    <label for="newpassword">New Password: </label>
    <input name="newpassword" type="password" class="form-field" placeholder="Type your new password here"required>
</div>

<div>
    <label for="newpassword">Retype New Password: </label>
    <input name="re-newpassword" type="password" class="form-field" placeholder="Retype your new password here"required>
</div>

    <button class="button" type="submit">Change Password</button>
</form>

<a href="talent-dashboard.php"><button class="button">Back to Dashboard</button></a>
</section>
</main>


<?php
include "components/footer.php";
?>