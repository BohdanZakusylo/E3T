<?php
$cssFile = "talent-dashboard";
$pageTitle = "talent-dashboard";
include "components/header.php";
?>

<body>
<main>
<section>
<div>
    <!-- php code to get the cover picture -->
	<img src="#"/>
</div>
</section>

<sub-section>
   
    <div class="profile">
        <div class="profile-align">
        <div class="profile_pic">
            <!-- php code to get the profile picture -->
            <img src="components/avatar.jpg"/>
        </div>

        <div>
            <button class="button"><a href="edit-profile.php">Edit Profile</a></button>
        </div>
</div>

        <div class="profile_name">
         <!--  php code to get (Name of talent) from the database   -->    
        <h3>
        (Name of talent)
        </h3>
        </div>
</div>

<div class="description">
    <h4>Description</h4>
    <!-- php code to replace this lorep ipsum below -->
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione
    </p>
</div>

<div>
    <h2><center>Media Gallery</center><h2>
<div>
    <div class="media-container">
   <!-- php code for media here -->
     <?php 
     $x = 9;

     for ($i=0; $i<$x; $i++) {
       echo "<div class='media'>
        </div>";
     }
    ?> 
</div>
</div>



<div class="form-container">

<h2><center>Uploads<center></h2>
<form method="POST" action="" enctype="multipart/form-data" id="form">
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
