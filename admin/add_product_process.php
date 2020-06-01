<?php
        
    include ('../config.php');

    session_start();

    $componentID = $_POST['componentID'];
    $componentName = $_POST['componentName'];
    $product = $_POST['product'];
	
	$insert_sql = "INSERT INTO products VALUES 
		(null,'$product',$componentID,now(),now())";

	mysqli_query($con, $insert_sql) or die("Insert Error: ".mysqli_error($con));

	$productID = mysqli_insert_id($con);

	$notif_sql = "INSERT INTO notifications VALUES 
		(null,$productID,0,0,0,0)";

	mysqli_query($con, $notif_sql) or die("Insert Error: ".mysqli_error($con));

	$_SESSION['addProductSuccess'] = 'Product '.$product.' had been successfully added in the system under Component '.$componentName;
    
    header("location:products.php?id=$componentID&component=$componentName");

?>