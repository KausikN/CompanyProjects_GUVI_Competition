<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {

		$db = mysqli_connect('localhost', 'root', 'mysql', 'registration');
		$query = "UPDATE users SET loggedin = 0;";
		mysqli_query($db, $query);

		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>