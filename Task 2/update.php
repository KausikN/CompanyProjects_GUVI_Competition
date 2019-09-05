<?php include('update_backend.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="update.php">

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $username_old ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $email_old ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1" placeholder="<?php echo $password_old ?>">
		</div>

		<div class="input-group">
			<label>Address</label>
			<input type="text" name="address" placeholder="<?php echo $address_old ?>">
		</div>
		<div class="input-group">
			<label>Phone Number</label>
			<input type="text" name="phone" placeholder="<?php echo $phone_old ?>">
		</div>
		<div class="input-group">
			<label>Date of Birth</label>
			<input type="text" name="DOB" placeholder="<?php echo $DOB_old ?>">
		</div>
		<div class="input-group">
			<label>Nationality</label>
			<input type="text" name="nationality" placeholder="<?php echo $nationality_old ?>">
		</div>

		<div class="input-group">
			<button type="submit" class="btn" name="update_user">Update</button>
		</div>
		
		<div class="input-group">
			<p> <a href="display.php" style="color: orange;">Back</a> </p>
		</div>
		<div class="input-group">
			<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
		</div>


	</form>
</body>
</html>