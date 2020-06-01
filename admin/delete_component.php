<?php
	  
	session_start();

	include ('../config.php');
				
	$id = $_GET['id'];

	$sql_delete = "DELETE components, products, notifications FROM components
					LEFT JOIN products ON components.id = products.componentID
					LEFT JOIN notifications ON products.id = notifications.productID
					WHERE components.id=$id";

	$result = mysqli_query($con,$sql_delete) or die("DeleteFailed" . mysqli_error($con));
					
	$_SESSION['componentDeleted'] = 'Component had been deleted from the system';
    
    header("location:settings.php");
				
?>