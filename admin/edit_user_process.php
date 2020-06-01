<?php

	// including the database connection file
	include('../config.php');

	session_start();
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	$icNumber = $_POST['icNumber'];
	$gender = $_POST['gender'];
	$phoneNumber = $_POST['phoneNumber'];
	$emailAddress = $_POST['emailAddress'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];
    
	//updating the table
	$update_sql = "UPDATE users SET name='$name',icNumber='$icNumber',gender='$gender',phoneNumber='$phoneNumber',emailAddress='$emailAddress',username='$username',password='$password',role='$role',lastUpdated=now() WHERE id='$id'";
	
	$result = mysqli_query($con, $update_sql) or die("Update error: " .mysqli_error($con));

	$_SESSION['userEditSuccess'] = 'User '.$name.' info in the system had been successfully updated';
		
	header("location:edit_user.php?id=$id");

?>