<?php

	// including the database connection file
	include('../config.php');

	session_start();
	
	$id = $_POST['id'];
	$productID = $_POST['productID'];
	$bloodType = $_POST['bloodType'];
	$donorID = $_POST['donorID'];
	$retrievedDate = $_POST['retrievedDate'];
	
	//updating the table
	$update_sql = "UPDATE bloodbag SET productID='$productID',bloodType='$bloodType',donorID='$donorID',retrievedDate='$retrievedDate',lastEdited=now() WHERE id='$id'";
	
	$result = mysqli_query($con, $update_sql) or die("Update error: " .mysqli_error($con));

	$_SESSION['bloodbagEditSuccess'] = 'Bloodbag '.$id.' info in the system had been successfully updated';
		
	header("location:edit_bloodbag.php?id=$id");

?>