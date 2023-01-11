<?php
//if (empty($_GET["talent"])){
//    header("Location: talents.php?talent=Singers");
//    var_dump($_GET["talent"]);
//}
$cssFile = "talents";
$pageTitle = "talents";
include ("components/header.php");
require "components/portfolio.php";
require "db_connection/connection.php";
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

		<form method="GET" action="talents.php">
			<label for="talents" class="label">Talent Categories<br></label>
			<select name="talent" id="talents">
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

        <?php
        echo "<div id='rows'>";
        if (!empty($_GET["talent"])){
            $outputs = $db->prepare("SELECT * FROM Talent WHERE talent = :talent");
            $outputs->bindParam(":talent", $_GET["talent"]);
            $outputs->execute();
            while($output = $outputs->fetch()){
                $s_id = $output["id"];
                $picture = $output["profilepic_url"];
                $url = "../media-files/$s_id/profile_pic/$picture";
                if (is_null($output["from_date_absent"]) AND is_null($output["to_date_absent"])) {
                    $aviable = "available";
                    generate_portfolio($url, $output["first_name"], $output["last_name"], $output["talent"], $output["description"], $output["price_per_hour"], $aviable, $output["id"]);
                }
                else{
                    $aviable = "Not available\nFrom".$output["from_date_absent"]. "To".$output["to_date_absent"];
                    generate_portfolio($url, $output["first_name"], $output["last_name"], $output["talent"], $output["description"], $output["price_per_hour"], $aviable, $output["id"]);
                }
            }
        }
        else{
            $singers = $db->prepare('SELECT * FROM Talent WHERE talent = "Singers"');
            $singers->execute();
            while($singer = $singers->fetch()){
                $s_id = $singer["id"];
                $picture = $singer["profilepic_url"];
                $url = "../media-files/$s_id/profile_pic/$picture";
                if (is_null($singer["from_date_absent"]) AND is_null($singer["to_date_absent"])) {
                    $aviable = "available";
                    generate_portfolio($url, $singer["first_name"], $singer["last_name"], $singer["talent"], $singer["description"], $singer["price_per_hour"], $aviable, $singer["id"]);
                }
                else{
                    $aviable = "Not available<br>From " . $singer["from_date_absent"]. "To ". $singer["to_date_absent"];
                    generate_portfolio($url, $singer["first_name"], $singer["last_name"], $singer["talent"], $singer["description"], $singer["price_per_hour"], $aviable, $singer["id"]);
                }
            }

        }
        echo "</div>";
        ?>


    </sub-section>
</main>



<?php
include "components/footer.php";
?>