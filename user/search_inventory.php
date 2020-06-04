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

        $productID = $_POST['productID'];
        $keyword = $_POST['keyword'];
        
        $sql = "SELECT donors.id AS donorID, donors.name, bloodbag.id, bloodbag.displayBloodbagID, bloodbag.bloodType, bloodbag.retrievedDate, bloodbag.expiryDate, bloodbag.dateCreated, bloodbag.lastEdited
          FROM donors LEFT JOIN bloodbag 
          ON donors.id = bloodbag.donorID
          WHERE bloodbag.productID = $productID AND bloodbag.status = 'In Stock' AND (bloodbag.displayBloodbagID LIKE '$keyword' OR bloodbag.bloodType LIKE '$keyword' OR donors.name LIKE '%$keyword%')";
    
        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        $sql1 = "SELECT * FROM products WHERE id = $productID";

        $result1 = mysqli_query($con,$sql1) or die("Cannot execute sql: ".mysqli_error($con));

        $productData = mysqli_fetch_assoc($result1);
        
        $rowCount = 1;

      ?>

      <h3>Product Inventory</h3>

      <div class="pull-right">
        <form class="form-inline" method="POST" action="search_inventory.php">
          <input type="hidden" name="productID" value="<?php echo $productID; ?>">
          <div class="input-group">
            <input type="text" class="form-control" name="keyword" required>
            <span class="input-group-btn">
              <button class="btn btn-danger" type="submit">Search Blood Bag</button>
            </span>
          </div>

          <a class="btn btn-danger" href="register_user.php" role="button">New Blood Bag</a>

        </form>
      </div>

      <div class="table-container">

        <div class="row">
          <div class="col-lg-12"><p>Search result for <b><?php echo $keyword; ?></b>:</p></div>
        </div>

        <br>

        <div class="row">
          <div class="col-md-2"><b>Product</b>:</div>
          <div class="col-md-10"><?php echo $productData['product']; ?></div>
        </div>

        <br>

        <table class="table">

          <thead>
            <tr>
              <th>#</th>
              <th>ID</th>
              <th>Blood Type</th>
              <th>Donor Name</th>
              <th>Retrieved Date</th>
              <th>Expiry Date</th>
              <th>Date Created</th>
              <th>Last Edited</th>
              <th colspan="2">Action</th>
            </tr>
            </tr>
          </thead>
        
          <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) :?>
            <tr>
            <td><?php echo $rowCount; ?></td>
            <td><?php echo $row['displayBloodbagID']; ?></td>
            <td><?php echo $row['bloodType']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['retrievedDate']; ?></td>
            <td><?php echo $row['expiryDate']; ?></td>
            <td><?php echo $row['dateCreated']; ?></td>
            <td><?php echo $row['lastEdited']; ?></td>
            <td><a href="edit_bloodbag.php?id=<?php echo $row['id']; ?>" class="page-link">Edit</a></td>
            <td>
              <a href="#" class="page-link" data-toggle="modal" data-target="#myModal-<?php echo $row['id']; ?>">Delete</a>
              <!-- Modal -->
              <div class="modal fade" id="myModal-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Discard Bloodbag: <b><?php echo $productData['product'].' - '.$row['displayBloodbagID'] ?></b></h4>
                  </div>
                  <form method="POST" action="discard_bloodbag.php">
                    <div class="modal-body">
                      You are about to delete <b><?php echo $productData['product'].' - '.$row['displayBloodbagID'] ?></b> from the inventory. Enter remarks & click confirm to proceed.<br>
                      
                      <input type="hidden" name="deleteFlag" value="error">
                      <input type="hidden" name="bloodbagID" value="<?php echo $row['id']; ?>">
                      <!--<input type="text" name="remarks" placeholder="Enter remarks" required>-->
                      <input type="text" class="form-control" placeholder="Enter remarks" name="remarks" required>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-danger">Confirm</button> 
                    </div>
                  </form>
                </div>
              </div>
            </div>
            </td>
            </tr>
            <?php endwhile; ?>

            <?php if(mysqli_num_rows($result) == 0): ?>
            <tr><td colspan="10"><?php echo 'No result found for <b>'.$keyword.'</b>'; ?></td></tr>
            <?php endif; ?>
          </tbody>

        </table>

      </div>

      <div class="pull-right">
        <a href="bloodbag.php?id=<?php echo $productID; ?>" class="btn btn-default" role="button">Back</a>
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
