<?php

	// including the database connection file
	include('../config.php');

	session_start();
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	$icNumber = $_POST['icNumber'];
	$gender = $_POST['gender'];
	$birthDate = $_POST['birthDate'];
	$bloodType = $_POST['bloodType'];
	$phoneNumber = $_POST['phoneNumber'];
	$emailAddress = $_POST['emailAddress'];
	
	//updating the table
	$update_sql = "UPDATE donors SET name='$name',icNumber='$icNumber',gender='$gender',birthDate='$birthDate',bloodType='$bloodType',phoneNumber='$phoneNumber',emailAddress='$emailAddress',lastUpdated=now() WHERE id='$id'";
	
	$result = mysqli_query($con, $update_sql) or die("Update error: " .mysqli_error($con));

	$_SESSION['donorEditSuccess'] = 'Donor '.$name.' info in the system had been successfully updated';
		
	header("location:edit_donor.php?id=$id");

?>