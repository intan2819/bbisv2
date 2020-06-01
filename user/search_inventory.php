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
        $category = $_POST['category'];
        $keyword = $_POST['keyword'];

        if($category == 'bagID'){

          $displayCategory = 'Bloodbag ID';

          $sql = "SELECT * FROM bloodbag WHERE id LIKE $keyword AND productID LIKE $productID";
    
          $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        }elseif($category == 'bloodType'){

          $displayCategory = 'Blood Type';

          $sql = "SELECT * FROM bloodbag WHERE bloodType LIKE '$keyword' AND productID LIKE $productID";
    
          $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        }
        
        $rowCount = 1;

      ?>

      <div class="pull-right">
        <form class="form-inline" method="POST" action="search_inventory.php">
          <input type="hidden" name="productID" value="<?php echo $productID; ?>">
          <div class="form-group">
            <select class="form-control" name="category" required>
              <option value="" disabled selected>Select Category</option>
              <option value="bagID">Bloodbag ID</option>
              <option value="donor">Donor</option>
              <option value="bloodType">Blood Type</option>
            </select>
          </div>
          <div class="input-group">
            <input type="text" class="form-control" name="keyword" required>
            <span class="input-group-btn">
              <button class="btn btn-danger" type="submit">Search</button>
            </span>
          </div>
        </form>
      </div>

      <div class="row">
        <div class="col-lg-12"><p>Search result for <b><?php echo $keyword." in ".$displayCategory; ?> category: </b></p></div>
      </div>

      <table class="table">

        <thead>
          <tr>
            <th>#</th>
            <th>ID</th>
            <th>Blood Type</th>
            <th>Donor Name</th>
            <th>Retrieved Date</th>
            <th>Expiry Date</th>
            <th colspan="2">Action</th>
          </tr>
          </tr>
        </thead>
      
        <tbody>
          <?php while($row = mysqli_fetch_assoc($result)) :?>
          <tr>
          <td><?php echo $rowCount; ?></td>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['bloodType']; ?></td>
          <td><?php echo ""; ?></td>
          <td><?php echo $row['retrievedDate']; ?></td>
          <td><?php echo $row['expiryDate']; ?></td>
          <td><a href="">Edit</a></td>
          <td>
            <a href="#" data-toggle="modal" data-target="#myModal-<?php echo $row['id']; ?>">Delete</a>
            <!-- Modal -->
            <div class="modal fade" id="myModal-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Discard Bag: <b><?php echo $row['bloodType'].' '.$row['id']; ?></b></h4>
                  </div>
                  <div class="modal-body">
                    You are about to discard <b><?php echo $row['bloodType'].' '.$row['bloodType']; ?></b> from BBIS. Click confirm to proceed.
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href=".php?id=<?php echo $row['id']; ?>" role="button">Confirm</a>
                  </div>
                </div>
              </div>
            </div>
          </td>
          </tr>
          <?php endwhile; ?>

          <?php if(mysqli_num_rows($result) == 0): ?>
          <tr><td colspan="10"><?php echo 'No result found for <b>'.$displayCategory.'</b>'; ?></td></tr>
          <?php endif; ?>
        </tbody>

      </table>

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
