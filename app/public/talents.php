<?php
$cssFile = "talents";
$pageTitle = "talents";
include ("components/header.php");
require "components/portfolio.php";
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
		<h2>Talents</h2>

		<form method="" action="">
			<label for="talents" class="label">Talent Categories<br></label>
			<select name="talents" id="talents">
				<option>Singers</option>
				<option>Dancers</option>
				<option>Magicians</option>
				<option>Comedians</option>
				<option>Djs</option>
				<option>Jugglers</option>
				<option>Actors</option>
				<option>Others</option>
			</select>
		</form>

		<div>
            <?php
                echo "<div id='rows'>";
                for ($i=0; $i<=4; $i++){
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
include "components/footer.php";
?>
