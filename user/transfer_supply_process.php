<?php
        
    include ('../config.php');

    session_start();

    $hospitalID = @$_POST['hospitalID'];

    $field_count = count($_POST['product']);

    $remarks = $_POST['remarks'];

    $duplicate = [];

	foreach(array_count_values($_POST['product']) as $value => $value_count){

		if($value_count > 1){

			$duplicate[] = $value;

		}

	}

	//Check for duplicated value inserted in the form
	if($duplicate){

		$_SESSION['duplicateFound'] = 'Please request a product only once per transaction';

        header("location:transfer_supply.php");

	}else{

		for ($i=0; $i < $field_count; $i++){
		
			$product = $_POST['product'][$i];
			$bloodType = $_POST['bloodType'][$i];
			$count = $_POST['count'][$i];
			
			$sql = "SELECT COUNT(bloodbag.productID) AS bloodbagCount, products.product
					FROM products LEFT JOIN bloodbag
					ON products.id = bloodbag.productID
					WHERE products.id = '$product' AND bloodbag.status = 'In Stock'";
			
			$result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

	        $data = mysqli_fetch_assoc($result);

	        //Check for bloodbag count of each product of the blood type requested
	        if($data['bloodbagCount'] < $count){

	        	$_SESSION['notEnough'] = 'The requested amount of product '.$data['product'].' exceeds the amount of the product in stock. Currently there are only '.$data['bloodbagCount'].' in the inventory';

	        	header("location:transfer_supply.php");
	        	die();

	        }
			
		}

		for ($i=0; $i < $field_count; $i++){
		
			$product = $_POST['product'][$i];
			$bloodType = $_POST['bloodType'][$i];
			$count = $_POST['count'][$i];
			
			$sql = "SELECT bloodbag.displayBloodbagID, bloodbag.id, bloodbag.productID
					FROM bloodbag
					WHERE bloodbag.productID = '$product' AND bloodbag.status = 'In Stock'
					LIMIT $count";
			
			$result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

	        $bloodBagID = [];

	        $actualID = [];

		    while($row = mysqli_fetch_assoc($result)){

		    	array_push($bloodBagID, $row['displayBloodbagID']);
		    	array_push($actualID, $row['id']);

		    }
			
		}

		$sql2 = "SELECT MAX(id) FROM transactions";

		$result2 = mysqli_query($con, $sql2);

		$row = mysqli_fetch_array($result2);

		$displayTransactionID = 'T'.sprintf("%05d", $row[0] + 1);

		//Save the display IDs in bloodbag ID column in 'transaction' table
		$transaction_sql = "INSERT INTO transactions VALUES 
				(null, '$displayTransactionID', ".$_SESSION['userid'].", $hospitalID, '".json_encode($bloodBagID)."','Transfer Bloodbag','$remarks',now())";
			
		$result_transaction = mysqli_query($con, $transaction_sql) or die("Insert error: " .mysqli_error($con));

		$transaction_id = mysqli_insert_id($con);

		//Change the bloodbag status to 'Transferred'
	    foreach($actualID as $id){

	    	$update_sql = "UPDATE bloodbag SET status = 'Transferred' WHERE id = $id";
		
			$update_result = mysqli_query($con, $update_sql) or die("Update error: " .mysqli_error($con));

	    }

	    $_SESSION['transactionSuccess'] = 'The transaction had been successfully recorded';

	    header("location:transaction_details.php?id=".$transaction_id);

	}

?>