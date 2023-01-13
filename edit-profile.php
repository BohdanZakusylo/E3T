<?php
session_start();
if (!isset($_SESSION['tLogin'])) {
    header("Location: login.php");
}

$cssFile = "edit-profile";
$pageTitle = "edit-profile.php";
include ("components/header.php");
require "db_connection/connection.php";


if (isset($_SESSION['upload'])) {
    echo "Successfully Uploaded";
    unset($_SESSION['upload']);
}

?>

    <?php
    $talent_id = $_SESSION["id"];
    $query = "SELECT * FROM Talent WHERE id = ?";
    $stmt = $db ->prepare($query);
    $stmt -> bindparam(1, $talent_id, PDO::PARAM_INT);
    $stmt -> execute();
    $value = $stmt -> fetch(PDO::FETCH_ASSOC);
    // I created a variable $finalstore here to specify directory of profile picture and to make the code below more readable
    $profilestore = "media-files/". $talent_id . "/profile_pic";
    $finalstore = $profilestore . "/" . $value['profilepic_url'];
    $default = "img/". $value['profilepic_url'];
    ?>
    <main>
        <section>
            <div>
                <h2 class="dashboard">Edit Profile</h2>
            </div>
        </section>
        <sub-section>
            <div class="profile">
                <div style="background-image: url('<?php echo $finalstore ?>'), url('<?php echo $default ?>');">
                </div>
            </div>
            <div class="main">
                <?php
					if(isset($_POST['first_name'])) {
						$first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
						$query = "UPDATE Talent SET first_name = ? WHERE id = ?";
						$stmt = $db->prepare($query);
						$stmt->bindparam(1, $first_name, PDO::PARAM_STR);
						$stmt->bindparam(2, $talent_id, PDO::PARAM_INT);
						$final = $stmt->execute();
						if ($final) {
							echo "First Name updated successfully";
						}
					}
                ?>
                <h3><b>
                    Edit profile
                </h3></b>
                <h2>First name:</h2>
                <form action="" method="POST">
                    <input type="text" name="first_name" id="first_name"  value="<?= $value['first_name']; ?>">
                    <input type="submit" value = "Update First Name"/>
                </form>
				
                <?php
					if(isset($_POST['last_name'])) {
						$last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
						$query = "UPDATE Talent SET last_name = ? WHERE id = ?";
						$stmt = $db->prepare($query);
						$stmt->bindparam(1, $last_name, PDO::PARAM_STR);
						$stmt->bindparam(2, $talent_id, PDO::PARAM_INT);
						$final = $stmt->execute();
						if ($final) {
							echo "Last Name updated successfully";
						}
					}
                ?>
                <h2>Last name:</h2>
                <form action="" method="POST">
                    <input type="text" name="last_name" id="last_name"  value="<?= $value['last_name']; ?>">
                    <input type="submit" value="Update last name"></input>
                </form>
                <?php
					if(isset($_POST['description'])) {
						$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
						$query = "UPDATE Talent SET description = ? WHERE id = ?";
						$stmt = $db->prepare($query);
						$stmt->bindparam(1, $description, PDO::PARAM_STR);
						$stmt->bindparam(2, $talent_id, PDO::PARAM_INT);
						$final = $stmt->execute();
						if ($final) {
							echo "Description Updated successfully";
						}
					}
                ?>
                <h4>Description</h4>
                <form action="" method="POST">
                    <input type="text" name="description" id="description" value="<?= $value['description']; ?>">
                    <input type="submit" value="Update description"></input>
                </form>

                <?php
					if(isset($_POST['price'])) {
						$price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);

						$talent_id = $_SESSION["id"];
						$query = "UPDATE Talent SET price_per_hour = ? WHERE id = ?";
						$stmt = $db->prepare($query);
						$stmt->bindparam(1, $price, PDO::PARAM_INT);
						$stmt->bindparam(2, $talent_id, PDO::PARAM_INT);

						$final = $stmt->execute();

						if ($final) {
							echo "Price updated successfully";
						}


					}
                ?>
                <h2>Price/hour</h2>
                <form action="" method="POST">
                    <input type="number" name="price" id="price"  value="<?= $value['price_per_hour']; ?>" min="0" max="1000">
                    <input type="submit" value="Update price"></input>
                </form>
                <?php
					if(isset($_POST['fromdate'])) {
						$fromdate = filter_input(INPUT_POST, "fromdate", FILTER_SANITIZE_SPECIAL_CHARS);
						if(strlen($fromdate)===0){
							$talent_id = $_SESSION["id"];
							$query = "UPDATE Talent SET from_date_absent = NULL WHERE id = ?";
							$stmt = $db->prepare($query);
							$stmt->bindparam(1, $talent_id, PDO::PARAM_INT);

							$final = $stmt->execute();
						}
						else{
							$talent_id = $_SESSION["id"];
							$query = "UPDATE Talent SET from_date_absent = ? WHERE id = ?";
							$stmt = $db->prepare($query);
							$stmt->bindparam(1, $fromdate, PDO::PARAM_STR);
							$stmt->bindparam(2, $talent_id, PDO::PARAM_INT);

							$final = $stmt->execute();
						}
						if ($final) {
							echo "Vacation start updated successfully";
						}
					}
                ?>
                <h2>Vacation start (format: 2002-06-07)</h2>
                <form action="" method="POST">
                    <input type="text" name="fromdate" id="fromdate"  value="<?= $value['from_date_absent']; ?>">
                    <input type="submit" value="Update date"></input>
                </form>
                <?php
					if(isset($_POST['todate'])) {
						$todate = filter_input(INPUT_POST, "todate", FILTER_SANITIZE_SPECIAL_CHARS);
						if(strlen($todate)===0){
							$talent_id = $_SESSION["id"];
							$query = "UPDATE Talent SET to_date_absent = NULL WHERE id = ?";
							$stmt = $db->prepare($query);
							$stmt->bindparam(1, $talent_id, PDO::PARAM_INT);

							$final = $stmt->execute();
						}
						else{
							$talent_id = $_SESSION["id"];
							$query = "UPDATE Talent SET to_date_absent = ? WHERE id = ?";
							$stmt = $db->prepare($query);
							$stmt->bindparam(1, $todate, PDO::PARAM_STR);
							$stmt->bindparam(2, $talent_id, PDO::PARAM_INT);

							$final = $stmt->execute();
						}
						if ($final) {
							echo "Vacation end updated successfully";
						}
					}
                ?>
                <h2>Vacation end (format: 2002-06-07)</h2>
                <form action="" method="POST">
                    <input type="text" name="todate" id="todate"  value="<?= $value['to_date_absent']; ?>">
                    <input type="submit" value="Update date"></input>
                </form>
                <div class="upload">

                    <br><br>
                    <form action="media-files/profile-img.php" method="POST" enctype="multipart/form-data">
                        <label for="file-upload" class="custom-file-upload">
                            <i class="fa fa-cloud-upload"></i> Upload Profile Image
                        </label>
                        <input id="file-upload" name='file' type="file" style="display:none;">
                        <input type="submit" name="edit_image" value="Update profile picture"></input>
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
            </div>
        </sub-section>
    </main>
    </body>
    </html>
<?php
	include "components/footer.php";
?>