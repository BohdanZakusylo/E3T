<?php
session_start();
$cssFile = "talent-dashboard";
$pageTitle = "talent-dashboard";
if(!isset($_SESSION["tLogin"])){ #Redirects to login if not logged in
    header("Location: login.php");
}

    if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
}

include "components/header.php";

//this takes the session talent_id from the login page
$talent_id = $_SESSION['id'];


?>

<body>
    <?php 
    require_once ("db_connection/connection.php");

    $query = "SELECT * FROM Talent WHERE id = ?";
    $stmt = $db ->prepare($query);
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
   <h2 class="dashboard">Dashboard</h2>
</div>
</section>

<sub-section>
  <!-- the div below is for the profile picture  -->
    <div class="profile">
        <div class="profile-align">
            <div class="profile_pic">
        <div style="background-image: url('<?= $finalstore ?>');">
        </div>
</div>
    <!-- this div below is for the Edit button  -->
        <div>
            <button class="button"><a href="edit-profile.php">Edit Profile</a></button>
        </div>
</div>
 <!-- and this is for the first name and last name of the talent  -->
        <div class="profile_name">   
        <h3>
        <?= $value['first_name']. " " . $value['last_name']; ?>
        </h3>
        </div>
</div>

<!-- this is for the description  -->
<div class="description">
    <h4>Description</h4>
    <p class="describe"><?= $value['description'] ?></p>
</div>


<!-- here is the media Gallery section  -->
<div>
    <h2><center>Media Gallery</center><h2>
</div>
    <div class="media-container">
     <?php 
    //  the lines of code below is to fetch information directly from the folder containing the media 
        $path = "media-files/". $talent_id . "/";
        $extensions = array('jpg', 'jpeg', 'gif', 'png');
        $images = glob($path."*.{".implode(',',$extensions)."}",GLOB_BRACE);
      
        
        foreach($images as $image) {
           
				echo '<div class="media">
                <a href="#">
                <div style="background-image: url('. $image. ');"></div>
                    </div>
                    </a>';

            } 

            ?> 
</div>



<div class="form-container">

<h2><center>Uploads<center></h2>
<form method="POST" action="media-files/media.php" enctype="multipart/form-data" id="form">
    <div >
    <label for="gallery"><p>Media Gallery:</p></label>
    <input type="file" name="gallery" id="form-img"><br>
     
    <button type="submit" name="submit" class="form-button" >Upload</button>
    </div>
</form>

</div>

    </sub-section>

    <div class="change">
    <form method="POST" action="" class="logout">
    <div>
            <button class="button" type="submit" name="logout">Logout</a></button>
    </div>
        </form>
    
    <div>
            <button class="button" type="submit" name="changepw"><a href="change-password.php">Change Password</a></button>
    </div>
</main>
</body>

<?php
include "components/footer.php";
?>