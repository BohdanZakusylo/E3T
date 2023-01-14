<?php
    session_start();

    require __DIR__ . "/PHPMailer-master/src/PHPMailer.php";
    require __DIR__ . "/PHPMailer-master/src/Exception.php";
    require __DIR__ . "/PHPMailer-master/src/SMTP.php";


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    $emailAddress = $_SESSION['emailAddress'];

    if(!isset($_SESSION["aLogin"])){ #Redirects to log in if not logged in
        header("Location: admin-login.php");
    }

    include "db_connection/connection.php";
    if (!empty($_GET)) {

        $outputs = $db->prepare("SELECT  first_name, last_name, talent, email, description FROM Requests WHERE request_id = :request_id");
        $outputs->bindParam(":request_id", $_GET["id"]);
        $outputs->execute();
        while ($output = $outputs->fetch()) {

            $query = "DELETE FROM Requests WHERE request_id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam("id", $_GET['id']);
            if ($stmt->execute()) {
                try {

                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->Username = "e3tproject@gmail.com";
                    $mail->Password = "kzwlwysxxrstdkue";
                    $mail->Subject = "Your request to become one of our talents at E3T was declined";
                    $mail->CharSet = PHPMailer::CHARSET_UTF8;
                    $mail->setFrom("e3tproject@gmail.com", "E3T");
                    $mail->Body =
                        $firstName . " " . $lastName . ", </p>" .
                        "<p><h2>We are sorry to inform you that your request to become one of our talent at E3T was declined</h2></p>";
                    $mail->isHTML();
                    $mail->addAddress("$emailAddress", $firstName . " " . $lastName);
                    $mail->send();
                    $mail->smtpClose();
                } catch
                (Exception $e) {
                }
            }
        }
    }
    header("Location: requests.php");
