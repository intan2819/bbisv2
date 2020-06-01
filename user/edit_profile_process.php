<?php

	// including the database connection file
	include('../config.php');

	session_start();
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	$icNumber = $_POST['icNumber'];
	$gender = $_POST['gender'];
	$phoneNumber = $_POST['phoneNumber'];
    
	//updating the table
	$update_sql = "UPDATE users SET name='$name',icNumber='$icNumber',gender='$gender',phoneNumber='$phoneNumber',lastUpdated=now() WHERE id='$id'";
	
	$result = mysqli_query($con, $update_sql) or die("Update error: " .mysqli_error($con));

	$_SESSION['profileEditSuccess'] = 'Your info in the system had been successfully updated';
		
	header("location:edit_profile.php");

?>