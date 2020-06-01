<?php
        
    include ('../config.php');

    session_start();

    $name = $_POST['name'];
	$shelfLife = $_POST['shelfLife'];
	$prefix = $_POST['prefix'];
	
	$insert_sql = "INSERT INTO components VALUES 
		(null,'$name',$shelfLife,'$prefix',now(),now())";

	mysqli_query($con, $insert_sql) or die("Insert Error: ".mysqli_error($con));

	$_SESSION['addComponentSuccess'] = 'Component '.$name.' had been successfully created in the system';
    
    header("location:settings.php");

?>