<?php

	// including the database connection file
	include('../config.php');

	session_start();
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	$shelfLife = $_POST['shelfLife'];
	$prefix = $_POST['prefix'];
    
	//updating the table
	$update_sql = "UPDATE components SET name='$name',shelfLife=$shelfLife,prefix='$prefix',lastEdited=now() WHERE id='$id'";
	
	$result = mysqli_query($con, $update_sql) or die("Update error: " .mysqli_error($con));

	$_SESSION['componentEditSuccess'] = 'Component '.$name.' info in the system had been successfully updated';
		
	header("location:edit_component.php?id=$id");

?>