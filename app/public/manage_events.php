<?php


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
				<form action="" method="POST">
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