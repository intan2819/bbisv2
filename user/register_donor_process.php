<?php
        
    include ('../config.php');

    session_start();

    $name = $_POST['name'];
	$icNumber = $_POST['icNumber'];
	$gender = $_POST['gender'];
	$birthDate = $_POST['birthDate'];
	$bloodType = $_POST['bloodType'];
	$phoneNumber = $_POST['phoneNumber'];
	$emailAddress = $_POST['emailAddress'];
	
	$insert_sql = "INSERT INTO donors VALUES 
		(null,'$name','$icNumber','$gender','$birthDate','$bloodType','$phoneNumber','$emailAddress',now(),now())";

	mysqli_query($con, $insert_sql) or die("Insert Error: ".mysqli_error($con));

	$_SESSION['donorRegistrationSuccess'] = 'Donor '.$name.' had been successfully registered into the system';
    
    header("location:donor.php");

?>