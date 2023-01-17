<?php 
	session_start();
	//Initialise
	$id = 1;

	$username = "";
	$password = "";
	$email    = "";

	$address    = "";
	$phone    = "";
	$DOB    = "";
	$nationality    = "";

	//

	$db = mysqli_connect('localhost', 'root', 'mysql', 'registration');
	$query = "SELECT id FROM users WHERE loggedin = 1;";
	$results = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($results);
	$id = $row['id'];

	$str_data = file_get_contents("data.json");
	$data = json_decode($str_data,true);

	$username = $data["Userdata"][$id-1]["username"];
	$password = $data["Userdata"][$id-1]["password"];
	$email    = $data["Userdata"][$id-1]["email"];
	$address    = $data["Userdata"][$id-1]["address"];
	$phone    = $data["Userdata"][$id-1]["phone"];
	$DOB    = $data["Userdata"][$id-1]["DOB"];
	$nationality    = $data["Userdata"][$id-1]["nationality"];


	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
	$_SESSION['email'] = $email;
	$_SESSION['address'] = $address;
	$_SESSION['phone'] = $phone;
	$_SESSION['DOB'] = $DOB;
	$_SESSION['nationality'] = $nationality;


?>

