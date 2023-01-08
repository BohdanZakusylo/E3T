<?php
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		// $event_name=filter_input(INPUT_POST, "name_event");
		// $start_date=filter_input(INPUT_POST, "start_date");
		// $end_date=filter_input(INPUT_POST, "end_date");
		// $time=filter_input(INPUT_POST, "time");
		// $place=filter_input(INPUT_POST, "place");
		// $description=filter_input(INPUT_POST, "description");
		// $performing_talent=filter_input(INPUT_POST, "performing_talent");
	}
	
	if(isset($_GET["add"])){
		if($_GET['add']=="true"){
			try{
				$db= new PDO("mysql:host=mysql;dbname=E3T;charset=UTF8", "root", "qwerty");
				$query=$db->prepare("INSERT INTO Events VALUES(NULL, :event_name, :start_date, :end_date, :time, NULL, NULL, :place, :description, 0)");
				
				$query->bindParam(':event_name', $_REQUEST['name_event']);
				$query->bindParam(':start_date', $_REQUEST['start_date']);
				$query->bindParam(':end_date', $_REQUEST['end_date']);
				$query->bindParam(':time', $_REQUEST['time']);
				$query->bindParam(':place', $_REQUEST['place']);
				$query->bindParam(':description', $_REQUEST['description']);
				
				
				$query->execute();
			}catch(Exception $ex){
				echo $ex;
			}
		}
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
				<form action="manage_events.php?add=true" method="POST">
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
						<input type="text" name="performing_talent" class="input_text" required>
					</div>
					
					<input type="file">
					
					<div>
						<button type="submit">Register event</button>
					</div>
				</form>
				
			</div>
			
			<div class="delete_events">
				<div class="spacing">
					<h2>Delete event</h2>
					<form action="" method="POST" class="form_margin">
						<label for="delete_talent" class="label">Name of event</label> <br>
						<select name="delete_talent" class="input_text" required>
							<option>PHP HERE</option>
						</select>
						<div class="delete_button">
							<button type="submit">Delete Event</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="go_back">
			<a href="" class="back">Go back</a>
		</div>
		
	</body>
</html>