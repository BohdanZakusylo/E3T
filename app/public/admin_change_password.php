<?php
 session_start();
$cssFile = "change-password";
$pageTitle = "Change Password";
try {
    $dbHandler = new PDO("mysql:host=localhost;dbname=e3t;charset=utf8", "root", "emperor");
}
catch (Exception $e){
    echo $e->getMessage();
}

if(!isset($_SESSION['aLogin'])) {
    header("Location: login.php");
}

include ("components/header.php");

$Admin_id = $_SESSION['user_id'];

?>

    <main>

        <section class="container">
            <form method="POST" action="">
                <div class="headcon">
                    <h3>Change your Password</h3>
                </div>
                <?php

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $current_password = filter_input(INPUT_POST, "currentpassword");
                    $new_password = filter_input(INPUT_POST, "newpassword");
                    $re_new_password = filter_input(INPUT_POST, "re-newpassword");

                    if(!empty($new_password) && !empty($re_new_password)) {


//                        require_once("db_connection/connection.php");
                        $query = "SELECT * from user WHERE user_id = ?";
                        $stmt = $dbHandler->prepare($query);
                        $stmt->bindparam(1, $Admin_id, PDO::PARAM_INT);
                        $stmt->execute();

                        $value = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($current_password != $new_password) {
                            if ($value) {
                                $dbpassword = $value['pass_hash'];

                                if (password_verify($current_password, $dbpassword)) {
                                    if ($new_password == $re_new_password) {
                                        if (strlen($new_password) > 7) {
                                            if (!ctype_lower($new_password) && !ctype_upper($new_password) && !ctype_digit($new_password)) {
                                                if (preg_match('@[0-9]@', $new_password)) {
                                                    if (!is_numeric($new_password)) {

                                                        $pass_hash = password_hash($new_password, PASSWORD_BCRYPT);


                                                        $query = "UPDATE user SET pass_hash = ? WHERE user_id=?";
                                                        $stmt = $dbHandler->prepare($query);
                                                        $stmt->bindparam(1, $pass_hash);
                                                        $stmt->bindparam(2, $Admin_id, PDO::PARAM_INT);
                                                        $update = $stmt->execute();

                                                        if ($update) {
                                                            echo "<p class='noerror'>Your password has been updated</p>";
                                                        }

                                                    } else {
                                                        echo "<p class='error'>Password must contain a Lower and Upper case alphabet and Number</p>";
                                                    }

                                                } else {
                                                    echo "<p class='error'>Password must contain a Lower and Upper case alphabet and Number</p>";
                                                }
                                            } else {
                                                echo "<p class='error'>Password must contain a Lower and Upper case alphabet and Number</p>";
                                            }

                                        } else {
                                            echo "<p class='error'>Password is too short, it must be a minimum of 8 characters</p>";
                                        }
                                    } else {
                                        echo "<p class='error'>New Password do not match!</p>";
                                    }

                                } else {
                                    echo "<p class='error'>current password is incorrect!</p>";
                                }

                            } else {
                                echo "<p class='error'>Couldn't fetch your information from the database!</p>";
                            }
                        }
                        else{
                            echo "<p class='error'>New password cannot be the same with old password!</p>";
                        }
                    } else {
                        echo "<p class='error'>Password fields cannot be empty</p>";
                    }
                }


                ?>

                <div>
                    <label for="currentpassword">Current Password: </label>
                    <input name="currentpassword" type="password" class="form-field" placeholder="Type your current password here" required id="currentpassword">
                </div>

                <div>
                    <label for="newpassword">New Password: </label>
                    <input name="newpassword" type="password" class="form-field" placeholder="Type your new password here" required id="newpassword">
                </div>

                <div>
                    <label for="newpassword">Retype New Password: </label>
                    <input name="re-newpassword" type="password" class="form-field" placeholder="Retype your new password here" required id="newpassword">
                </div>

                <button class="button" type="submit">Change Password</button>
            </form>

            <a href="admin-dashboard.php"><button class="button">Back to Dashboard</button></a>
        </section>
    </main>


<?php
include "components/footer.php";
?>