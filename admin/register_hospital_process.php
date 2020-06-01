<?php
        
    include ('../config.php');

    session_start();

    $name = $_POST['name'];
	$address = $_POST['address'];
	$town = $_POST['town'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	$phoneNumber = $_POST['phoneNumber'];
	$fax = $_POST['fax'];
	$emailAddress = $_POST['emailAddress'];
	
	$insert_sql = "INSERT INTO hospitals VALUES 
		(null,'$name','$address','$town','$state','$postcode','$phoneNumber','$fax','$emailAddress',now(),now())";

	mysqli_query($con, $insert_sql) or die("Insert Error: ".mysqli_error($con));

	$_SESSION['hospitalRegistrationSuccess'] = '<b>'.$name.'</b> had been successfully registered into the system';
    
    header("location:hospital.php");

?>