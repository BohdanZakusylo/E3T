<?php

session_start();

$user_id = $_SESSION['user_id'];


if($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_FILES['gallery']['name'];
            $size = $_FILES['gallery']['size'];
            $tmp_name = $_FILES['gallery']['tmp_name'];
            $error = $_FILES['gallery']['error'];
            $type = $_FILES['gallery']['type'];


            if ($error == 0) {

                $acceptedtype = ['image/png', "image/jpeg", "image/jpg", "image/gif", "video/mp4", "video/mkv",];
                $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                $uploadfiletype = finfo_file($fileinfo, $tmp_name);

                if (in_array($uploadfiletype, $acceptedtype)) {

                    if (!is_dir($user_id)) {
                        mkdir($user_id);
                        if(!file_exists($user_id . "/" .$name)) {
                            move_uploaded_file($tmp_name, $user_id. "/" . $name);
                            echo "File uploaded successfully<br><br> <a href='talent-dashboard.php'>Return back to Dashboard </a>";
                    } else {
                        echo "File already exist";
                    }
                }  else {
                        if(!file_exists($user_id . "/" .$name)) {
                            move_uploaded_file($tmp_name, $user_id. "/" . $name);
                    }
                    else {
                        echo "File already exist";
                    }  

                }} else {
                    echo "Upload a supported file type (PNG, JPEG, MP4 or MKV)";
                }

            } else {
                echo "An error was encountered while uploading" ;
            }
    }
?>