<?php
session_start();
$Admin_id = $_SESSION['id'];


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_FILES['file']['name'];
    $type = $_FILES['file']['type'];
    $size = $_FILES['file']['size'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $error = $_FILES['file']['error'];

   
    $acceptedsize = 2*1024*1024;            

    if ($error == 0) {
        if ($size < $acceptedsize) {
            $acceptedtype = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
            $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
            $uploadfiletype = finfo_file($fileinfo, $tmp_name);

            if (in_array($uploadfiletype, $acceptedtype)) {
              
                $query =  "UPDATE Talent SET profilepic_url = ? WHERE id = ?";
                require_once("../db_connection/connection.php");
                $stmt = $db->prepare($query);
                $stmt -> bindparam(1, $name, PDO::PARAM_STR);
                $stmt -> bindparam(2, $Admin_id, PDO::PARAM_INT);
                $final = $stmt ->execute();

                if ($final) {

           // The code below is to check if the folder(media-files/$talent_id/profile_pic exist already, if it does, then move to the else code but if not make a new directory named (media-files/$talent_id/profile_pic) and place the picture in there using move_uploaded_file      

                if (!is_dir($Admin_id. "/profile_pic")) {
                
                    mkdir($Admin_id. "/profile_pic"); // this will create an empty folder for the new profile picture
                    move_uploaded_file($tmp_name, $Admin_id. "/profile_pic" . "/" . $name); //this will upload the picture into the folder
                    echo "Uploaded successfully";
                    header("Location: ../edit-profile.php");
                    echo "Successfully Updated";
                }
            } else {
                $file = glob($Admin_id . '/profile_pic/*');
                unlink($file[0]);  //this will delete the previous profile picture from the director
                    move_uploaded_file($tmp_name, $Admin_id. "/profile_pic" . "/" . $name);
                   header("Location: ../edit-profile.php");
                   echo "Successfully Updated";
            }
        } else {
            echo "Couldn't update information in the database";
        }

        } else {
            echo "file size is too big";
        }
    } else {
        echo "an error occured while uploading";
    }

}


?>