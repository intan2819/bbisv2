<?php

	// including the database connection file
	include('../config.php');

	session_start();
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$town = $_POST['town'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	$phoneNumber = $_POST['phoneNumber'];
	$fax = $_POST['fax'];
	$emailAddress = $_POST['emailAddress'];
    
	//updating the table
	$update_sql = "UPDATE hospitals SET hospitalName='$name',address='$address',town='$town',state='$state',postcode=$postcode,phoneNumber='$phoneNumber',fax='$fax',emailAddress='$emailAddress',lastUpdated=now() WHERE id='$id'";
	
	$result = mysqli_query($con, $update_sql) or die("Update error: " .mysqli_error($con));

	$_SESSION['hospitalEditSuccess'] = $name.' info in the system had been successfully updated';
		
	header("location:edit_hospital.php?id=$id");

?>