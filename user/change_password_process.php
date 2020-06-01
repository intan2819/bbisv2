<?php

	// including the database connection file
	include('../config.php');

	session_start();
	
	$id = $_SESSION['userid'];
	$currentPassword = $_POST['currentPassword'];
	$newPassword = $_POST['newPassword'];

	$sql = "SELECT password FROM users WHERE id = '$id'";

	$result = mysqli_query($con, $sql) or die("Cannot execute sql" .mysqli_error($con));

	$row = mysqli_fetch_assoc($result);

	$dbPassword = $row['password'];

	if($currentPassword == $dbPassword){

		//updating the table
		$update_sql = "UPDATE users SET password='$newPassword', lastUpdated=now() WHERE id='$id'";
		
		$result = mysqli_query($con, $update_sql) or die("Update error: " .mysqli_error($con));

		$_SESSION['changePasswordSuccess'] = 'Your password had been successfully changed';
			
		header("location:change_password.php");

	}else{

		$_SESSION['changePasswordFailed'] = 'Password change failed. The current password does not match the password that you entered';
			
		header("location:change_password.php");

	}
    
	

?>