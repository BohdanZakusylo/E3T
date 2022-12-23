<?php

session_start();

$talent_id = $_SESSION['talent_id'];


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

                    if (!is_dir($talent_id)) {
                        mkdir($talent_id);
                        if(!file_exists($talent_id . "/" .$name)) {
                            move_uploaded_file($tmp_name, $talent_id. "/" . $name);
                            header("Location: ../talent-dashboard.php");
                            // echo "File uploaded successfully<br><br> <a href='talent-dashboard.php'>Return back to Dashboard </a>";
                    } else {
                        echo "File already exist";
                    }
                }  else {
                        if(!file_exists($talent_id . "/" .$name)) {
                            move_uploaded_file($tmp_name, $talent_id. "/" . $name);
                            header("Location: ../talent-dashboard.php");
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