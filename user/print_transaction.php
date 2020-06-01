<?php

	include('../config.php');
	include_once('../fpdf/WriteHTML.php');

	class PDF extends PDF_HTML{

		// Page header
		function Header(){

		    $this->SetFont('Arial','B',13);
		    // Title
		    $this->Cell(0,10,'Transaction Details',0,1,'C');
		    // Line break
		    $this->Ln(10);

		}
 
		// Page footer
		function Footer(){

		    // Position at 1.5 cm from bottom
		    $this->SetY(-15);
		    // Arial italic 8
		    $this->SetFont('Arial','I',8);
		    // Page number
		    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

		}

	}

	$transactionID = $_GET['id'];

	$sql = "SELECT transactions.id, transactions.displayTransactionID, users.id AS userID, users.name, hospitals.id, hospitals.hospitalName, transactions.bloodBagID, transactions.transaction, transactions.remarks, transactions.dateCreated
		FROM transactions LEFT JOIN users
        ON transactions.userID = users.id
        LEFT JOIN hospitals ON transactions.hospitalID = hospitals.id
        WHERE transactions.id = $transactionID";

    $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

    while($row = mysqli_fetch_assoc($result)){

        $displayTransactionID = $row['displayTransactionID'];
        $committedBy = $row['name'];
        $hospitalName = $row['hospitalName'];
        $bloodBagID = $row['bloodBagID'];
        $transaction = $row['transaction'];
        $remarks = $row['remarks'];
       	$dateCreated = $row['dateCreated'];
  
    }

    $rowCount = 1;

    $pdf = new PDF();

	//header
	$pdf->AddPage();

	//footer page
	$pdf->AliasNbPages();

	$pdf->SetFont('Arial','',10);

	$html_line1 = '<b>Transaction ID:</b> '.$displayTransactionID;

	$html_line2 = '<b>Committed By:</b> '.$committedBy;

	$html_line3 = '<b>Hospital:</b> '.$hospitalName;

	$html_line4 = '<b>Transaction:</b> '.$transaction;

	$html_line5 = '<b>Remarks:</b> '.$remarks;

	$html_line6 = '<b>Transaction Date:</b> '.$dateCreated;

	$html_line7 = '<b>Blood Bag:</b>';
				
	$pdf->writeHTML($html_line1.'<br>'.$html_line2.'<br>'.$html_line3.'<br>'.$html_line4.'<br>'.$html_line5.'<br>'.$html_line6.'<br>'.$html_line7);

	$pdf->Ln(10);

	$pdf->SetFont('Arial','B',10);

	$pdf->SetLeftMargin(25);

	$header = array('#', 'Bloodbag ID');

	foreach($header as $heading){

		$pdf->Cell(35,10,$heading,1);

	}

	$bloodBagList = json_decode($bloodBagID);

	$newArray = [];

	foreach ($bloodBagList as $bloodBag){

		array_push($newArray, ['bil' => $rowCount, 'bloodbag_id' => $bloodBag]);
		$rowCount++;

	}

	foreach($newArray as $row){
		$pdf->SetFont('Arial','',10);
		$pdf->Ln();
		foreach($row as $column)
		$pdf->Cell(35,10,$column,1);
	}

	$pdf->Output();

?>