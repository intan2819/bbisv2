<?php

	// including the database connection file
	include('../config.php');

	session_start();
	
	$id = $_POST['id'];
	$product = $_POST['product'];
	$componentID = $_POST['componentID'];
	$typeAcount = $_POST['typeAcount'];
	$typeBcount = $_POST['typeBcount'];
	$typeOcount = $_POST['typeOcount'];
	$typeABcount = $_POST['typeABcount'];
    
	//updating the products table
	$update_products_tbl = "UPDATE products SET product='$product',componentID=$componentID,lastEdited=now() WHERE id=$id";
	
	$result = mysqli_query($con, $update_products_tbl) or die("Update error: " .mysqli_error($con));

	//updating notifications table
	$update_notifs_tbl = "UPDATE notifications SET typeAcount=$typeAcount, typeBcount=$typeBcount, typeOcount=$typeOcount, typeABcount=$typeABcount WHERE productID=$id";
	
	$result = mysqli_query($con, $update_products_tbl) or die("Update error: " .mysqli_error($con));

	$result2 = mysqli_query($con, $update_notifs_tbl) or die("Update error: " .mysqli_error($con));

	$_SESSION['productEditSuccess'] = 'Product '.$product.' info in the system had been successfully updated';
		
	header("location:edit_product.php?id=$id");

?>