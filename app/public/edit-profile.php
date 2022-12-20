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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile</title>
</head>
<body>
<main>
<section>
    <div>
        <img src="components/cover/jpg">
    </div>
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
            <input type="text" name="full_name" id="full_name" placeholder="Enter your full name here"><br>
  <div class="description">
    <h4>Description</h4>
    <!-- php code to replace this lorep ipsum below -->
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione
</p>
    </div>   
    
    <div class="upload">
    <form action="edit-profile.php" method="POST" enctype="multipart/form-data">

                

            <input type="file" id="upload" hidden/>
            <label for="upload"><p>Upload Profile Picture<p></label>



                
    </div>
        <div class="upload">
            <input type="file" id="upload" hidden/>
            <label for="upload"><p>Upload Cover Image</p></label>

        </div>
        <input type="submit" name="submit" value="submit"></input>
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