<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/bbisv2/img/icon.png">

    <title>Blood Bank Inventory System</title>

    <!-- Bootstrap core CSS -->
    <link href="/bbisv2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/bbisv2/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/bbisv2/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/bbisv2/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <?php include('navbar.php'); ?>

    <div class="container page-container">

      <?php

        include ('../config.php');

        $transactionID = $_GET['id'];

        $sql = "SELECT transactions.id, transactions.displayTransactionID, users.id AS userID, users.name, hospitals.id, hospitals.hospitalName, transactions.bloodbagID, transactions.transaction, transactions.remarks, transactions.dateCreated 
        FROM transactions LEFT JOIN users
        ON transactions.userID = users.id
        LEFT JOIN hospitals ON transactions.hospitalID = hospitals.id
        WHERE transactions.id = $transactionID";

        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        while($row = mysqli_fetch_assoc($result)){

          $displayTransactionID = $row['displayTransactionID'];
          $committedBy = $row['name'];
          $hospitalName = $row['hospitalName'];
          $bloodBagID = $row['bloodbagID'];
          $transaction = $row['transaction'];
          $remarks = $row['remarks'];
          $dateCreated = $row['dateCreated'];
  
        }

        $rowCount = 1;

        if(isset($_SESSION['transactionSuccess'])){

          echo "<div class='alert alert-success' role='alert'>".$_SESSION['transactionSuccess']."</div>";
          unset($_SESSION['transactionSuccess']);

        }

      ?>

      <h3>Transaction Details</h3><br>

        <div class="row">
          <div class="col-md-2"><b>Transaction ID</b>:</div>
          <div class="col-md-10"><?php echo $displayTransactionID; ?></div>
        </div>
        <div class="row">
          <div class="col-md-2"><b>Hospital</b>:</div>
          <div class="col-md-10"><?php echo $hospitalName; ?></div>
        </div>
        <div class="row">
          <div class="col-md-2"><b>Transaction</b>:</div>
          <div class="col-md-10"><?php echo $transaction; ?></div>
        </div>
        <div class="row">
          <div class="col-md-2"><b>Remarks</b>:</div>
          <div class="col-md-10"><?php echo $remarks; ?></div>
        </div>
        <div class="row">
          <div class="col-md-2"><b>Committed By</b>:</div>
          <div class="col-md-10"><?php echo $committedBy; ?></div>
        </div>
        <div class="row">
          <div class="col-md-2"><b>Date Committed</b>:</div>
          <div class="col-md-10"><?php echo $dateCreated; ?></div>
        </div>

        <br>
            
        <table class="table">

          <tr>
            <th>#</th>
            <th>Bloodbag ID</th>
          </tr>

          <?php 

            $listOfBloodBag = json_decode($bloodBagID);

            foreach ($listOfBloodBag as $bloodBag): ?>
            <tr>
              <td><?php echo $rowCount; ?></td>
              <td><?php echo $bloodBag; ?></td>
            </tr>

          <?php

            $rowCount++;
            endforeach;

          ?>

        </table>

        <div class="pull-right">
          <a href="print_transaction.php?id=<?php echo $transactionID; ?>" class="btn btn-danger" role="button" target="_blank">Print</a>
          <a href="transaction.php" class="btn btn-default" role="button">Back</a>
        </div>
        

      <?php include('../logout.php'); ?>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/bbisv2/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/bbisv2/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/bbisv2/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
