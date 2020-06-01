<?php
        
    include ('../config.php');

    session_start();

    $productID = $_POST['productID'];
	$bloodType = $_POST['bloodType'];
	$donorID = $_POST['donorID'];
	$retrievedDate = $_POST['retrievedDate'];

	$sql = "SELECT components.name, components.shelfLife, components.prefix FROM components
			LEFT JOIN products
			ON components.id = products.componentID
			WHERE products.id = '$productID'";

    $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

    $componentData = mysqli_fetch_assoc($result);

	$expiryDate = date('Y-m-d', strtotime($retrievedDate. ' + '.$componentData['shelfLife'].' days'));

	$insert_sql = "INSERT INTO bloodbag VALUES 
		(null,$productID,null,'$bloodType',$donorID,'$retrievedDate','$expiryDate','In Stock',now(),now())";

	mysqli_query($con, $insert_sql) or die("Insert Error: ".mysqli_error($con));

	$last_id = sprintf("%05d", mysqli_insert_id($con));

	$displayBloodbagID = $componentData['prefix'].$productID.$last_id;

	$update_sql = "UPDATE bloodbag SET displayBloodbagID='$displayBloodbagID' WHERE id='$last_id'";
		
	$result = mysqli_query($con, $update_sql) or die("Update error: " .mysqli_error($con));

	$_SESSION['bloodBagAdditionSuccess'] = 'Bloodbag had been successfully registered into the system';
    
    header("location:bloodbag.php?id=$productID");

?>