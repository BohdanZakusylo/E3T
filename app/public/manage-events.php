<?php
	
	require "db_connection/connection.php";
	
	if(isset($_GET["add"])){
		if($_SERVER['REQUEST_METHOD']=='POST'){
		$target_dir="event_images/";
		$target_file=$target_dir.basename($_FILES['photo']['name']);
		move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
		$location=$target_dir.$_FILES["photo"]["full_path"];
		}
		
		if($_GET['add']=="true"){
				
			try{
				$query=$db->prepare("INSERT INTO Events VALUES(NULL, :event_name, :start_date, :end_date, :time, NULL, NULL, :place, :description, :image_url)");
				
				$query->bindParam(':event_name', $_REQUEST['name_event']);
				$query->bindParam(':start_date', $_REQUEST['start_date']);
				$query->bindParam(':end_date', $_REQUEST['end_date']);
				$query->bindParam(':time', $_REQUEST['time']);
				$query->bindParam(':place', $_REQUEST['place']);
				$query->bindParam(':description', $_REQUEST['description']);
				$query->bindParam(':image_url', $location);
				
				$query->execute();
				echo"<h2>Talent added</h2>";
			}catch(Exception $ex){
				echo $ex;
			}
		}
	}
	$count_id=$db->query("SELECT max(event_id) FROM Events");
	$id=$count_id->fetch();
	
	$delete=$db->query("SELECT name FROM Events");
	$event_delete=$delete->fetch();
	
	$count_talent=$db->query("SELECT COUNT(talent) FROM Talent");
	$nr_talent=$count_talent->fetch();
	
	if(isset($_GET["delete"])){
		if($_GET['delete']=="1")
			$delete_event_query=$db->prepare("DELETE FROM Events WHERE name=:deleted");
			$delete_event_query->bindParam(':deleted', $_POST['delete_talent']);
			$delete_event_query->execute();
			echo"<h2>Talent deleted</h2>";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Manage Events</title>
		<link rel="stylesheet" href="css/manage_events.css">
	</head>
	
	<body>
		<section class="events_manage">
			<h1>Events Management</h1>
		</section>
		
		<div class="main">
			<div class="add_events">
				<h2>Add new events</h2>
				<form action="manage-events.php?add=true" method="POST" enctype="multipart/form-data">
					<div class="spacing">
						<label class="label" for="name_event">Name of Event</label> <br>
						<input type="text" name="name_event" class="input_text" required>
					</div>
					
					<div class="spacing">
						<label class="label" for="start_date">Start date</label> <br>
						<input type="text" name="start_date" class="input_text" required>
					</div>
					
					<div class="spacing">
						<label class="label" for="end_date">End date</label> <br>
						<input type="text" name="end_date" class="input_text"required>
					</div>
					
					<div class="spacing">
						<label class="label" for="time">Time</label> <br>
						<input type="text" name="time" class="input_text" required>
					</div>
					
					<div class="spacing">
						<label class="label" for="place">Place of Event</label> <br>
						<input type="text" name="place" class="input_text" required>
					</div>
					
					<div class="spacing">
						<label class="label" for="description">Event description</label> <br>
						<input type="text" name="description" class="input_text" required>
					</div>
					
					<div class="spacing">
						<label class="label" for="performing_talent">Performing talent</label> <br>
						<select type="text" name="performing_talent" class="input_text" required>
							<option>Singers</option>
							<option>Dancers</option> 
							<option>Magicians</option>
							<option>Comedians</option>
							<option>DJs</option>
							<option>Jugglers</option>
							<option>Actors</option>
							<option>Others</option>
						</select>
					</div>
					
					<input name="photo" id="photo" type="file">
					
					<div>
						<button type="submit">Register event</button>
					</div>
				</form>
				
			</div>
			
			<div class="delete_events">
				<div class="spacing">
					<h2>Delete event</h2>
					<form action="manage-events.php?delete=1" method="POST" class="form_margin">
						<label for="delete_talent" class="label">Name of event</label> <br>
						<select name="delete_talent" class="input_text" required>
						<option></option>
							<?php
								for($i=0;$i<=$id[0];$i++){
									$delete=$db->query("SELECT name FROM Events WHERE event_id=".$i);
									$event_delete=$delete->fetch();
									if($event_delete){
										echo "<option>".$event_delete['name']."</option>";
									}
								}
							?>
						</select>
						<div class="delete_button">
							<button type="submit">Delete Event</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="go_back">
			<a href="index.php" class="back">Go back</a>
		</div>
		
	</body>
</html>