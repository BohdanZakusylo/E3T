<?php session_start();
$talent_id = $_SESSION['id'];

if(isset($_SESSION['upload'])) {
    header("Location: ../edit-profile.php");
}


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_FILES['file']['name'];


                if ($final) {

           // The code below is to check if the folder(media-files/$talent_id/profile_pic exist already, if it does, then move to the else code but if not make a new directory named (media-files/$talent_id/profile_pic) and place the picture in there using move_uploaded_file      

                    $final_location = $talent_id. "/profile_pic" . "/" . $name;

                if (!is_dir($talent_id. "/profile_pic")) {
           // The code below is to check if the folder(media-files/$talent_id/profile_pic exist already, if it does, then move to the else code but if not make a new directory named (media-files/$talent_id/profile_pic) and place the picture in there using move_uploaded_file      
                    if(!is_dir($talent_id)) {
                        mkdir($talent_id);

                     if (!is_dir($talent_id. "/profile_pic")) {

                    mkdir($talent_id. "/profile_pic"); // this will create an empty folder for the new profile picture
                    move_uploaded_file($tmp_name, $talent_id. "/profile_pic" . "/" . $name); //this will upload the picture into the folder
                    echo "Uploaded successfully";
                    header("Location: ../edit-profile.php");
                    echo "Successfully Updated";
                    move_uploaded_file($tmp_name, $final_location); //this will upload the picture into the folder

                    $_SESSION['upload'] = "Uploaded successfully";

                    // echo "Uploaded successfully";
                    // echo "Successfully Updated";

                    // echo "<form method='POST' action=''>

                    //     <input type='submit' name='submit'>
                    // </form>"
                }
            } else {
                $file = glob($talent_id . '/profile_pic/*');
                unlink($file[0]);  //this will delete the previous profile picture from the directory
                    move_uploaded_file($tmp_name, $talent_id. "/profile_pic" . "/" . $name);
                   header("Location: ../edit-profile.php");
                   echo "Successfully Updated";
                    $_SESSION['upload'] = "Uploaded successfully";
                //    header("Location: ../edit-profile.php");
                //    echo "Successfully Updated";
            }
        }elseif (is_dir($talent_id)) {
            if (!is_dir($talent_id. "/profile_pic")) {

                mkdir($talent_id. "/profile_pic"); // this will create an empty folder for the new profile picture
                move_uploaded_file($tmp_name, $final_location); //this will upload the picture into the folder
                $_SESSION['upload'] = "Uploaded successfully";
                // echo "Uploaded successfully";
                // header("Location: ../edit-profile.php");
                // echo "Successfully Updated";
        } else {
            $file = glob($talent_id . '/profile_pic/*');
            unlink($file[0]);  //this will delete the previous profile picture from the directory
                move_uploaded_file($tmp_name, $talent_id. "/profile_pic" . "/" . $name);
                $_SESSION['upload'] = "Uploaded successfully";
            //    header("Location: ../edit-profile.php");
            //    echo "Successfully Updated";
        }
    }

        } else {
            echo "Couldn't update information in the database";
        }

}


?> 