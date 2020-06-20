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

        $category = $_POST['category'];
        $keyword = $_POST['keyword'];

        if($category == 'transactionID'){

          $displayCategory = 'Transaction ID';

          $sql = "SELECT transactions.id, transactions.displayTransactionID, transactions.transaction, transactions.dateCreated, users.id AS userID, users.name, hospitals.id AS hospitalID, hospitals.hospitalName
            FROM transactions LEFT JOIN users
            ON transactions.userID = users.id
            LEFT JOIN hospitals ON transactions.hospitalID = hospitals.id
            WHERE transactions.displayTransactionID LIKE '$keyword'";

          $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        }elseif($category == 'userID'){

          $displayCategory = 'Committed By';

          $sql = "SELECT transactions.id, transactions.displayTransactionID, transactions.transaction, transactions.dateCreated, users.id AS userID, users.name, hospitals.id AS hospitalID, hospitals.hospitalName
            FROM transactions LEFT JOIN users
            ON transactions.userID = users.id
            LEFT JOIN hospitals ON transactions.hospitalID = hospitals.id
            WHERE users.name LIKE '%$keyword%'";
    
          $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        }elseif($category == 'lastNoOfDays'){

          $displayCategory = 'Last (N) Days';

          $sql = "SELECT transactions.id, transactions.displayTransactionID, transactions.transaction, transactions.dateCreated, users.id AS userID, users.name, hospitals.id AS hospitalID, hospitals.hospitalName
            FROM transactions LEFT JOIN users
            ON transactions.userID = users.id
            LEFT JOIN hospitals ON transactions.hospitalID = hospitals.id
            WHERE transactions.dateCreated BETWEEN NOW() - INTERVAL ".$keyword." DAY AND NOW()";
    
          $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        }
        
        $rowCount = 1;

      ?>

      <h3>Transaction</h3>

      <div class="pull-right">
        <form class="form-inline" method="POST" action="search_transaction.php">
          <div class="form-group">
            <select class="form-control" name="category" required>
              <option value="" disabled selected>Select Category</option>
              <option value="transactionID">Transaction ID</option>
              <option value="userID">Committed By</option>
              <option value="lastNoOfDays">Last (N) days</option>
            </select>
          </div>
          <div class="input-group">
            <input type="text" class="form-control" name="keyword" required>
            <span class="input-group-btn">
              <button class="btn btn-danger" type="submit">Search</button>
            </span>
          </div>
          <a href="transfer_supply.php" class="btn btn-danger" role="button">Transfer Supply</a>
        </form>
      </div>

      <div class="table-container">

        <div class="row">
          <div class="col-lg-12"><p>Search result for <b><?php echo $keyword."</b> in <b>".$displayCategory; ?></b> category: </p></div>
        </div>

        <table class="table">

          <tr>
            <th width="20%">#</th>
            <th>ID</th>
            <th>Transaction</th>
            <th>Hospital</th>
            <th>Committed By</th>
            <th>Date Committed</th>
          </tr>

          <?php while($row = mysqli_fetch_assoc($result)) :?>
          <tr>
            <td><?php echo $rowCount; ?></td>
            <td><a class="page-link" href="transaction_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['displayTransactionID']; ?></a></td>
            <td><?php echo $row['transaction']; ?></td>
            <td><?php echo $row['hospitalName']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['dateCreated']; ?></td>
          </tr>

          <?php

            $rowCount++;
            endwhile;

          ?>

          <?php if(mysqli_num_rows($result) == 0): ?>
          <tr><td colspan="6"><?php echo 'No result found for <b>'.$displayCategory.'</b>'; ?></td></tr>
          <?php endif; ?>

        </table>

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