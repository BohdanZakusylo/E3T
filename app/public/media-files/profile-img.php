<?php 
session_start();
$talent_id = $_SESSION['id'];

if(isset($_SESSION['upload'])) {
    header("Location: ../edit-profile.php");
}


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_FILES['file']['name'];
    $error = $_FILES['file']['error'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $type = $_FILES['file']['type'];
    $size = $_FILES['file']['size'];

    
            if ($error == 0) {
                $accepted_type = ["image/png", "image/jpeg", "image/jpg", "image/gif"];
                $file_info = finfo_open(FILEINFO_MIME_TYPE);
                $uploaded_file = finfo_file($file_info, $tmp_name);

                if (in_array($uploaded_file, $accepted_type)) {

                    require_once("../db_connection/connection.php");
                    $query = "UPDATE Talent SET profilepic_url = ? WHERE id = ?";
                    $stmt = $db->prepare($query);
                    $stmt->bindparam(1, $name);
                    $stmt->bindparam(2, $talent_id, PDO::PARAM_INT);
                    $final = $stmt->execute();

                    if ($final)  {

                    if (!is_dir($talent_id)) {
                        mkdir($talent_id);
                        if(!is_dir($talent_id. "/profile_pic")) {
                            mkdir($talent_id. "/profile_pic");
                            $finalstore = $talent_id. "/profile_pic" . "/" . $name;
                            move_uploaded_file($tmp_name, $talent_id. "/profile_pic" . "/" . $name);
                            $_SESSION['upload'] = "Uploaded successfully";
                            header("Location: ../edit-profile.php");
                        } else {
                            $file = glob($talent_id . '/profile_pic/*');
                            unlink($file[0]);  //this will delete the previous profile picture from the directory
                            move_uploaded_file($tmp_name, $talent_id. "/profile_pic" . "/" . $name);
                            $_SESSION['upload'] = "Uploaded successfully";
                            header("Location: ../edit-profile.php");
                        }


                    } elseif(is_dir($talent_id)) {

                      if(!is_dir($talent_id. "/profile_pic")) {
                        mkdir($talent_id. "/profile_pic");
                        $finalstore = $talent_id. "/profile_pic" . "/" . $name;
                        move_uploaded_file($tmp_name, $talent_id. "/profile_pic" . "/" . $name);
                        $_SESSION['upload'] = "Uploaded successfully";
                        header("Location: ../edit-profile.php");
                    
                    } else {
                        $file = glob($talent_id . '/profile_pic/*');
                        unlink($file[0]);  //this will delete the previous profile picture from the directory
                        move_uploaded_file($tmp_name, $talent_id. "/profile_pic" . "/" . $name);
                        $_SESSION['upload'] = "Uploaded successfully";
                        header("Location: ../edit-profile.php");
                    }

            } else {
                echo "Could update profile picture";
            } 

    }  else {
        echo "Please uploaded a supported file type (png, jpeg or jpg)";
    } 

} else {
    echo "An error occured while uploading your file"; 
    } 
}
}


?> 
