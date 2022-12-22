<?php
session_start();
$cssFile = "talent-dashboard";
$pageTitle = "talent-dashboard";
include "components/header.php";


$user_id = $_SESSION['user_id'];

?>

<body>
    <?php 
    require("connection.php");

    $query = "SELECT * FROM Talent WHERE user_id = ?";
    $stmt = $dbhandler ->prepare($query);
    $stmt -> bindparam(1, $user_id, PDO::PARAM_INT);
    $stmt -> execute();

    $value = $stmt -> fetch(PDO::FETCH_ASSOC);

    $profilestore = "media-files/". $user_id . "/profile_pic";
    $finalstore = $profilestore . "/" . $value['profilepic_url'];
        
?>



<main>


<section>
<div>
   <h2 class="dashboard">Dashboard</h2>
</div>
</section>

<sub-section>
  
    <div class="profile">
        <div class="profile-align">
        <div class="profile_pic">
            <img src="<?= $finalstore ?>"/>
        </div>

        <div>
            <button class="button"><a href="edit-profile.php?id=<?= $value['user_id'] ?>">Edit Profile</a></button>
        </div>
</div>

        <div class="profile_name">   
        <h3>
        <?= $value['first_name']. " " . $value['last_name']; ?>
        </h3>
        </div>
</div>

<div class="description">
    <h4>Description</h4>
    <p><?= $value['description'] ?></p>
</div>
<div>
    <h2><center>Media Gallery</center><h2>
<div>
    <div class="media-container">
     <?php 
 
       echo "<div class='media'>
        </div>";
     
    ?> 
</div>
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

    
</main>
</body>

<?php
include "components/footer.php";
?>
