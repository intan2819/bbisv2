<?php
	  
	session_start();

	include ('../config.php');
				
	$id = $_GET['id'];

	$componentID = $_GET['componentID'];

	$componentName = $_GET['componentName'];

	$sql_delete = "DELETE products, notifications FROM products
        		LEFT JOIN notifications ON products.id = notifications.productID
				WHERE products.id = $id";

	$result = mysqli_query($con,$sql_delete) or die("DeleteFailed" . mysqli_error($con));
					
	$_SESSION['productDeleted'] = 'The selected product had been deleted from the system';
    
    header("location:products.php?id=$componentID&component=$componentName");
				
?>