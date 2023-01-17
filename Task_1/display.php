<?php include('display_backend.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Display</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Display</h2>
	</div>
	
	<form method="post" action="display.php">

		<div class="input-group">
			<label>Username</label>
			<?php echo " ".$_SESSION['username']; ?>
		</div>
		<div class="input-group">
			<label>Email</label>
			<?php echo " ".$_SESSION['email']; ?>
		</div>
		<div class="input-group">
			<label>Password</label>
			<?php echo " ".$_SESSION['password']; ?>
		</div>

		<div class="input-group">
			<label>Address</label>
			<?php echo " ".$_SESSION['address']; ?>
		</div>
		<div class="input-group">
			<label>Phone Number</label>
			<?php echo " ".$_SESSION['phone']; ?>
		</div>
		<div class="input-group">
			<label>Date of Birth</label>
			<?php echo " ".$_SESSION['DOB']; ?>
		</div>
		<div class="input-group">
			<label>Nationality</label>
			<?php echo " ".$_SESSION['nationality']; ?>
		</div>

		<div class="input-group">
			<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
		</div>
	</form>
</body>
</html>