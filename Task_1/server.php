<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";

	$address    = "";
	$phone    = "";
	$DOB    = "";
	$nationality    = "";

	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', 'mysql', 'registration');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		$address = mysqli_real_escape_string($db, $_POST['address']);
		$phone = mysqli_real_escape_string($db, $_POST['phone']);
		$DOB = mysqli_real_escape_string($db, $_POST['DOB']);
		$nationality = mysqli_real_escape_string($db, $_POST['nationality']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if (empty($address)) { array_push($errors, "Address is required"); }
		
		if (empty($DOB)) { array_push($errors, "Date of Birth is required"); }
		if (empty($nationality)) { array_push($errors, "Nationality is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = $password_1;
			//$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password, address, phone, DOB, nationality, loggedin) 
					  VALUES('$username', '$email', '$password', '$address', '$phone', '$DOB', '$nationality', 1)";
			mysqli_query($db, $query);


			$query2 = "SELECT id FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query2);
			$row = mysqli_fetch_assoc($results);
			$id = $row['id'];

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
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = $password;

			//$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {

				$db = mysqli_connect('localhost', 'root', 'mysql', 'registration');
				$query2 = "UPDATE users SET loggedin = 1 WHERE username = '$username' AND password='$password';";
				mysqli_query($db, $query2);

				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	// ...


	/*

	{
"Userdata":
    [
        {
            "username" : "Kausik",
            "password": 123,
            "email": "a@b.com",
            "address": "aaa",
            "phone": "1234",
            "DOB": "1",
            "nationality": "a"
        }
    ]
}

	*/

?>



