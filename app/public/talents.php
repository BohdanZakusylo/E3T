<?php
$cssFile = "talents";
$pageTitle = "talents";
include ("components/header.php");
require "components/portfolio.php";

?>

<?php 
			
			if(isset($_GET)){
				$talent=$_GET['talents'];
			}
		?>

<main>

<section>
<div>
	<div class="container">
	<h3>Want a talent for your events?</h3>
	<p>E3T got you covered with the very best talents in emmen and surrounding</p>
	<div>
	</div>

</section>

	<sub-section id="mainbody">
		<?php echo"<center><h1>You are on " .$talent. " page</h1></center>"; ?>
		<h2>Talents</h2>

		<form method="GET">
			<label for="talents" class="label">Talent Categories<br></label>
			<select name="talents" id="talents">
				<option name="talent"><a href="talents.php?talent=singers">Singers</a></option>
				<option name="talent"><a href="talents.php?talent=dancers">Dancers</a></option>
				<option name="talent"><a href="talents.php?talent=magicians">Magicians</a></option>
				<option name="talent"><a href="talents.php?talent=comedians">Comedians</a></option>
				<option name="talent"><a href="talents.php?talent=djs">DJs</a></option>
				<option name="talent"><a href="talents.php?talent=jugglers">Jugglers</a></option>
				<option name="talent"><a href="talents.php?talent=actors">Actors</a></option>
				<option name="talent"><a href="talents.php?talent=others">Others</a></option>
			</select>
			<input type="submit" value="Submit">
		</form>

		<div>
            <?php
                echo "<div id='rows'>";
                for ($i=0; $i<5; $i++){
                    generate_portfolio();
                }
                echo "</div>";
            ?>
		</div>

		<div>
			<a href="#"><center>Next ></center></a>
		</div>
    </sub-section>
</main>

<?php

	
?>

<?php
include "components/footer.php";
?>
