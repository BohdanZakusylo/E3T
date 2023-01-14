<?php
	$cssFile = "display-profile";
	$pageTitle = "Display Profile";
	if(!isset($_GET['id'])) {
		header("Location: talents.php");
	}
	include "components/header.php";
	$talent_id = $_GET['id'];
?>

<body>
		<?php 
			require_once("db_connection/connection.php");

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
		   <h2 class="dashboard">Talent Profile</h2>
		</div>
		</section>

		<sub-section>
		  <!-- the div below is for the profile picture  -->
			<div class="profile">
				<div class="profile-align">
					<div class="profile_pic">
						<div style="background-image: url('<?= $finalstore ?>');"></div>
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
			<div class="gallery">
				<h2>Media Gallery<h2>
			</div>
			
			<div class="media-container">
				<?php 
		//  the lines of code below is to fetch information directly from the folder containing the media 
					$path = "media-files/". $talent_id . "/";
					$extensions = array('jpg', 'jpeg', 'gif', 'png');
					$images = glob($path."*.{".implode(',',$extensions)."}",GLOB_BRACE);
			  
					foreach($images as $image) {
						echo'<div class="media">
								<a href="#">
								<div style="background-image: url('. $image. ');"></div>
							</div>
							</a>';
					} 

					$extensions = array('mp4', 'mkv', '3gp', 'webm');
					$videos = glob($path."*.{".implode(',',$extensions)."}",GLOB_BRACE);

					foreach($videos as $video) {
						echo '<div class="video">
							<video controls src="'.$video.'" height="200px">
						</div>';
					}
				?> 
			</div>
		</sub-section>
	</main>
</body>

<?php
include "components/footer.php";
?>