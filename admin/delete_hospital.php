<?php
	  
	session_start();

	include ('../config.php');
				
	$id = $_GET['id'];

	$sql_delete="DELETE FROM hospitals WHERE id=$id";

	$result=mysqli_query($con,$sql_delete) or die("DeleteFailed" . mysqli_error($con));
					
	$_SESSION['hospitalDeleted'] = 'Hospital info had been deleted from the system';
    
    header("location:hospital.php");
				
?>