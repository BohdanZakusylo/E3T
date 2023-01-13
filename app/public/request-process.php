<?php
session_start();

    require __DIR__."/PHPMailer-master/src/PHPMailer.php";
    require __DIR__."/PHPMailer-master/src/Exception.php";
    require __DIR__."/PHPMailer-master/src/SMTP.php";


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    $fullName = $_SESSION['fullName'];
    $emailAddress = $_SESSION['emailAddress'];
    $talent = $_SESSION['talent'];
    $description = $_SESSION['description'];

    if(!isset($_SESSION["aLogin"])){ #Redirects to log in if not logged in
        header("Location: admin-login.php");
    }

    include "db_connection/connection.php";
        if (!empty($_GET)){
        $combination = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shuffle = str_shuffle($combination);
        $rand_pass_2 = substr($shuffle, 0, 8);
        $pass_hash = password_hash($rand_pass_2,PASSWORD_BCRYPT);

        $pass_hash = password_hash($rand_pass,PASSWORD_BCRYPT);
        $outputs = $db->prepare("SELECT  first_name, last_name, talent, email, description FROM Requests WHERE request_id = :request_id");
        $outputs->bindParam(":request_id", $_GET["id"]);
        $outputs->execute();

        while($output = $outputs->fetch()) {

            $insert = $db->prepare("INSERT INTO Talent(description, email, first_name, last_name, password, price_per_hour, profilepic_url, rating, talent) 
            VALUES(:description, :email, :first_name, :last_name, :pass_hash, 50, '', 1, :talent)");
            $insert->bindParam(":description", $output["description"]);
            $insert->bindParam(":email", $output["email"]);
            $insert->bindParam(":first_name", $output["first_name"]);
            $insert->bindParam(":last_name", $output["last_name"]);
            $insert->bindParam(":pass_hash", $pass_hash);
            $insert->bindParam(":talent", $output["talent"]);
            if ($insert->execute()) {
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
                        "<p>Welcome to E3t " . $fullName . "</p>" .
                        "<p><h2>You Request to become one of our talents at E3T has been approved. Below you will find your details as well as your randomly generated password</h2></p>" .
                        "<p>
                                    Full name: <b>$fullName</b><br>
                                    Talent: <b>$talent;</b><br>
                                    Email address: <b>$emailAddress;</b><br>
                                    Password (Change this password as soon as possible): <b>$rand_pass_2;</b><br>
                                    Description: <b>$description</b><br>
                                     </p>
                                     <p><a href='login.php'>Click this link to login</a></p>";
                    $mail->isHTML();
                    $mail->addAddress("$emailAddress", "$fullName");
                    $mail->send();
                    $mail->smtpClose();
                }
                catch
                (Exception $e) {
                    echo $e->getMessage();
                }
            }

            }
            $delete = $db->prepare("DELETE FROM Requests WHERE request_id = :id");
            $delete->bindParam(":id", $_GET["id"]);
            $delete->execute();
        }

        header("Location: confirmation.php");

    
?>