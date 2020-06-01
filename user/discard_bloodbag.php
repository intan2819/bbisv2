<?php

	// including the database connection file
	include('../config.php');
	include_once('../fpdf/fpdf.php');

	session_start();

    $deleteFlag = $_POST['deleteFlag'];

    if($deleteFlag == 'expired'){

        //Get all the expired bloodbag ID
        $sql = "SELECT bloodbag.id, bloodbag.displayBloodbagID, products.product, bloodbag.bloodType, donors.name, bloodbag.retrievedDate, bloodbag.expiryDate, bloodbag.dateCreated, bloodbag.lastEdited
            FROM bloodbag LEFT JOIN products
            ON bloodbag.productID = products.id
            LEFT JOIN donors ON bloodbag.donorID = donors.id
            WHERE bloodbag.expiryDate <= now() AND bloodbag.status = 'In Stock'";
        
        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        date_default_timezone_set('Asia/Kuala_Lumpur');

        $bloodBagID = [];

        while($row = mysqli_fetch_assoc($result)){

            array_push($bloodBagID, $row['displayBloodbagID']);

        }

        $sql2 = "SELECT MAX(id) FROM transactions";

        $result2 = mysqli_query($con, $sql2);

        $row = mysqli_fetch_array($result2);

        $displayTransactionID = 'T'.sprintf("%05d", $row[0] + 1);

        //Save the IDs in bloodbag ID column in 'transaction' table
        $transaction_sql = "INSERT INTO transactions VALUES 
            (null, '$displayTransactionID', ".$_SESSION['userid'].", null, '".json_encode($bloodBagID)."','Discard Bloodbag','Discard expired bloodbag',now())";
        
        $result_transaction = mysqli_query($con, $transaction_sql) or die("Insert error: " .mysqli_error($con));

        $transaction_id = mysqli_insert_id($con);

        //Change the bloodbag status to 'Discarded'
        $sql3 = "SELECT bloodbag.id FROM bloodbag LEFT JOIN products
            ON bloodbag.productID = products.id
            WHERE bloodbag.expiryDate <= now()";
        
        $result3 = mysqli_query($con,$sql3) or die("Cannot execute sql: ".mysqli_error($con));

        while($row = mysqli_fetch_assoc($result3)){

            $update_sql = "UPDATE bloodbag SET status = 'Discarded' WHERE id = '".$row['id']."' AND status = 'In Stock'";
        
            $update_result = mysqli_query($con, $update_sql) or die("Update error: " .mysqli_error($con));

        }

        $_SESSION['transactionSuccess'] = 'The transaction had been successfully executed';

        header("location:transaction_details.php?id=".$transaction_id);

    }else{

        //echo 'No remarks';

        $bloodbagID = $_POST['bloodbagID'];
        $remarks = $_POST['remarks'];

        //Get all the expired bloodbag ID
        $sql = "SELECT bloodbag.displayBloodbagID FROM bloodbag
            WHERE bloodbag.id = $bloodbagID";
        
        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        $bloodBagID = [];

        while($row = mysqli_fetch_assoc($result)){

            array_push($bloodBagID, $row['displayBloodbagID']);

        }

        $sql2 = "SELECT MAX(id) FROM transactions";

        $result2 = mysqli_query($con, $sql2);

        $row = mysqli_fetch_array($result2);

        $displayTransactionID = 'T'.sprintf("%05d", $row[0] + 1);

        //Save the IDs in bloodbag ID column in 'transaction' table
        $transaction_sql = "INSERT INTO transactions VALUES 
            (null, '$displayTransactionID', ".$_SESSION['userid'].", null, '".json_encode($bloodBagID)."','Discard Bloodbag','$remarks',now())";
        
        $result_transaction = mysqli_query($con, $transaction_sql) or die("Insert error: " .mysqli_error($con));

        $transaction_id = mysqli_insert_id($con);

        $update_sql = "UPDATE bloodbag SET status = 'Discarded' WHERE id = $bloodbagID";
        
        $update_result = mysqli_query($con, $update_sql) or die("Update error: " .mysqli_error($con));

        $_SESSION['transactionSuccess'] = 'The transaction had been successfully executed';

        header("location:transaction_details.php?id=".$transaction_id);

    }

?>