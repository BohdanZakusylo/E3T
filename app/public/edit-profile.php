<?php
 session_start();
$cssFile = "edit-profile";
$pageTitle = "edit-profile.php";
include ("components/header.php");
include "db_connection/connection.php";

if (!isset($_SESSION['tLogin'])) {
    header("Location: login.php");
}

if (isset($_SESSION['upload'])) {
    echo "Successfully Uploaded";
    unset($_SESSION['upload']);
}

    try{
        $dbHandler = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","root","qwerty"); 
        $dbHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $ex){
        echo "<p class='error'>The following error occured: $ex</p>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile</title>
</head>
<body>

    <?php

    $talent_id = $_SESSION["id"];

    $query = "SELECT * FROM Talent WHERE id = ?";
    $stmt = $dbHandler ->prepare($query);
    $stmt -> bindparam(1, $talent_id, PDO::PARAM_INT);
    $stmt -> execute();

    $value = $stmt -> fetch(PDO::FETCH_ASSOC);

    // I created a variable $finalstore here to specify directory of profile picture and to make the code below more readable

    $profilestore = "media-files/". $talent_id . "/profile_pic";
    $finalstore = $profilestore . "/" . $value['profilepic_url'];


    ?>
<main>
<section>
<div>
   <h2 class="dashboard">Edit Profile</h2>
</div>
</section>

<sub-section>
   
<div class="profile">
           <div style="background-image: url('<?php echo $finalstore ?>');">
        </div>
    </div>
<div class="main">
<?php 


    if(isset($_POST['first_name'])) {
            $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);

            $query = "UPDATE Talent SET first_name = ? WHERE id = ?";
            $stmt = $dbHandler->prepare($query);
            $stmt->bindparam(1, $first_name, PDO::PARAM_STR);
            $stmt->bindparam(2, $talent_id, PDO::PARAM_INT);
            $final = $stmt->execute();

            if ($final) {
                echo "First Name updated successfully";
            }


    }
?>

        <h3><b>
        Edit profile
        </h3></b>
            <h2>First name:</h2>
            <form action="" method="POST">
                
            <input type="text" name="first_name" id="first_name"  value="<?= $value['first_name']; ?>">
            <input type="submit" value = "Update First Name"/>
</form>



<?php 


if(isset($_POST['last_name'])) {
    $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "UPDATE Talent SET last_name = ? WHERE id = ?";
    $stmt = $dbHandler->prepare($query);
    $stmt->bindparam(1, $last_name, PDO::PARAM_STR);
    $stmt->bindparam(2, $talent_id, PDO::PARAM_INT);
    $final = $stmt->execute();

    if ($final) {
        echo "Last Name updated successfully";
    }


}
?>




<h2>Last name:</h2>
            <form action="" method="POST">
            <input type="text" name="last_name" id="last_name"  value="<?= $value['last_name']; ?>">
            <input type="submit" value="Update last name"></input>
</form>  



<?php 



if(isset($_POST['description'])) {
    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "UPDATE Talent SET description = ? WHERE id = ?";
    $stmt = $dbHandler->prepare($query);
    $stmt->bindparam(1, $description, PDO::PARAM_STR);
    $stmt->bindparam(2, $talent_id, PDO::PARAM_INT);
    $final = $stmt->execute();

    if ($final) {
        echo "Description Updated successfully";
    }
}
?>


<h4>Description</h4>
    <form action="" method="POST">
        <input type="text" name="description" id="description" value="<?= $value['description']; ?>">
        <input type="submit" value="Update description"></input>
    </form>



    <div class="upload">
         
<br><br>
<form action="media-files/profile-img.php" method="POST" enctype="multipart/form-data">
    <label for="file-upload" class="custom-file-upload">
    <i class="fa fa-cloud-upload"></i> Upload Profile Image
    </label>
    <input id="file-upload" name='file' type="file" style="display:none;">
    <input type="submit" name="edit_image" value="Update profile picture"></input>
</form>





<script>
    $('#file-upload').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload')[0].files[0].name;
  $(this).prev('label').text(file);
});
</script>

                
    </div>
</form>
</div>

</div>
</div>

</sub-section>

</main>
</body>
</html>


<?php
include "components/footer.php";
?>