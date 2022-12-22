<?php
 session_start();
$cssFile = "edit-profile";
$pageTitle = "edit-profile.php";
include ("components/header.php");
?>

<?php
    try{
        $dbHandler = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","root","qwerty"); 
        $dbHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connection sucessful";
        echo "<br>";
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
<main>
<section>
</section>

<sub-section>
   
<div class="profile">
        <div class="profile-align">
        <div class="profile_pic">
            <img src="#"/>
        </div>
</div>

        <div class="profile_name">



        <h3><b>
        Edit profile
        </h3></b>
            <h2>First name:</h2>
            <form action="edit-profile.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="first_name" id="first_name" placeholder="Enter your first name here"><br>
            <input type="submit" name="edit_first_name" value = "Edit frist name"/>
</form>

<h2>Last name:</h2>
            <form action="edit-profile.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="last_name" id="last_name" placeholder="Enter your last name here"><br>
            <input type="submit" name="edit_last_name" value="Edit last name"></input>
</form>  

<h4>Description</h4>
    <form action="edit-profile.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="description" id="description" placeholder="Edit your description"><br>
        <input type="submit" name="edit_description" value="Edit description"></input>
    </form>

    <div class="upload">
    <form action="edit-profile.php" method="POST" enctype="multipart/form-data">

                
<br><br>
<form action="edit-profile.php" method="POST" enctype="multipart/form-data">
    <label for="file-upload" class="custom-file-upload">
    <i class="fa fa-cloud-upload"></i> Upload Profile Image
    </label>
    <input id="file-upload" name='upload_cont_img' type="file" style="display:none;">
    <input type="submit" name="edit_image" value="Edit profile picture"></input>
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


</sub-section>

</main>
</body>
</html>


<?php
include "components/footer.php";
?>