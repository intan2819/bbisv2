<?php
        
    include ('../config.php');

    session_start();

    $name = $_POST['name'];
	$icNumber = $_POST['icNumber'];
	$gender = $_POST['gender'];
	$phoneNumber = $_POST['phoneNumber'];
	$emailAddress = $_POST['emailAddress'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	
	$insert_sql = "INSERT INTO users VALUES 
		(null,'$username','$name','$icNumber','$gender','$phoneNumber','$emailAddress','$password','$role',now(),now())";

	mysqli_query($con, $insert_sql) or die("Insert Error: ".mysqli_error($con));

	$_SESSION['userRegistrationSuccess'] = 'User '.$name.' had been successfully registered into the system';
    
    header("location:user.php");

?>