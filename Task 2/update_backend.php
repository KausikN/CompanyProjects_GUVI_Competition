<?php 
	session_start();
	//Initialise
	$id = 1;

	$username_old = "";
	$password_old = "";
	$email_old    = "";

	$address_old    = "";
	$phone_old    = "";
	$DOB_old   = "";
	$nationality_old    = "";
	//
	//
	$username = "";
	$password = "";
	$email    = "";

	$address    = "";
	$phone    = "";
	$DOB   = "";
	$nationality  = "";
	//

	$db = mysqli_connect('localhost', 'root', 'mysql', 'registration');
	$query = "SELECT id FROM users WHERE loggedin = 1;";
	$results = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($results);
	$id = $row['id'];

	$str_data = file_get_contents("data.json");
	$data = json_decode($str_data,true);

	$username_old = $data["Userdata"][$id-1]["username"];
	$password_old = $data["Userdata"][$id-1]["password"];
	$email_old    = $data["Userdata"][$id-1]["email"];
	$address_old    = $data["Userdata"][$id-1]["address"];
	$phone_old    = $data["Userdata"][$id-1]["phone"];
	$DOB_old    = $data["Userdata"][$id-1]["DOB"];
	$nationality_old    = $data["Userdata"][$id-1]["nationality"];


	$_SESSION['username_old'] = $username_old;
	$_SESSION['password_old'] = $password_old;
	$_SESSION['email_old'] = $email_old;
	$_SESSION['address_old'] = $address_old;
	$_SESSION['phone_old'] = $phone_old;
	$_SESSION['DOB_old'] = $DOB_old;
	$_SESSION['nationality_old'] = $nationality_old;


	////////////////////////////////

	$db = mysqli_connect('localhost', 'root', 'mysql', 'registration');

	// UPDATE USER
	if (isset($_POST['update_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password_1']);

		$address = mysqli_real_escape_string($db, $_POST['address']);
		$phone = mysqli_real_escape_string($db, $_POST['phone']);
		$DOB = mysqli_real_escape_string($db, $_POST['DOB']);
		$nationality = mysqli_real_escape_string($db, $_POST['nationality']);

		// form validation: ensure that the form is correctly filled
		
		if (empty($username)) { $username = $username_old; }
		if (empty($email)) { $email = $email_old; }
		if (empty($password)) { $password = $password_old; }

		if (empty($address)) { $address = $address_old; }
		
		if (empty($DOB)) { $DOB = $DOB_old; }
		if (empty($nationality)) { $nationality = $nationality_old; }
		

		// register user if there are no errors in the form
		//if (count($errors) == 0) {
			//$password = md5($password);//encrypt the password before saving in the database
			$query = "UPDATE users SET 
						username = '$username',
						email = '$email',
						password = '$password',
						address = '$address',
						phone = '$phone',
						DOB = '$DOB',
						nationality = '$nationality' WHERE id = '$id';";
			mysqli_query($db, $query);




			$str_data = file_get_contents("data.json");
			$data = json_decode($str_data,true);

			$data["Userdata"][$id-1]['username'] = $username;
			$data["Userdata"][$id-1]['password'] = $password;
			$data["Userdata"][$id-1]['email'] = $email;
			$data["Userdata"][$id-1]['address'] = $address;
			$data["Userdata"][$id-1]['phone'] = $phone;
			$data["Userdata"][$id-1]['DOB'] = $DOB;
			$data["Userdata"][$id-1]['nationality'] = $nationality;

			$str_data = json_encode($data);
			file_put_contents('data.json', $str_data);   

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "User details Updated";
			header('location: display.php');
		//}

	}

	////////////////////////////////

?>

