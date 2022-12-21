<?php
$cssFile = "edit-profile";
$pageTitle = "edit-profile.php";
include ("components/header.php");
?>

<?php
    try{
        $dbHandler = new PDO("mysql:host=mysql;dbname=E3T;charset=utf8","root","qwerty"); #Initialize DB connection
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
            <!-- php code to get the profile picture -->
            <img src="components/avatar.jpg"/>
        </div>
</div>

        <div class="profile_name">
         <!--  php code to get (Name of talent) from the database   -->    
        <h3><b>
        Edit profile
        </h3></b>
            <h2>Full name:</h2>
            <form action="edit-profile.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="full_name" id="full_name" placeholder="Enter your full name here"><br>
            <input type="submit" name="edit_name" value="Edit name"></input>

    <h4>Description</h4>
    <!-- php code to replace this lorep ipsum below -->
    <input type="text" name="description" id="description" placeholder="Edit your description"><br>
    <input type="submit" name="edit_description" value="Edit description"></input>


    <div class="upload">
    <form action="edit-profile.php" method="POST" enctype="multipart/form-data">

                
<br><br>
    <label for="file-upload" class="custom-file-upload">
    <i class="fa fa-cloud-upload"></i> Upload Profile Image
  </label>
  <input id="file-upload" name='upload_cont_img' type="file" style="display:none;">
  <input type="submit" name="edit_image" value="Edit profile picture"></input>

  <?php 
  


  ?>
  

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