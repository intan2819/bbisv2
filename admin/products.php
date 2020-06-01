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

        $componentID = $_GET["id"];

        $componentName = $_GET["component"];

        $sql = "SELECT * FROM products WHERE componentID = $componentID";

        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        if(isset($_SESSION['addProductSuccess'])){

          echo "<div class='alert alert-success' role='alert'>".$_SESSION['addProductSuccess']."</div>";
          unset($_SESSION['addProductSuccess']);

        }

        if(isset($_SESSION['productDeleted'])){

          echo "<div class='alert alert-danger' role='alert'>".$_SESSION['productDeleted']."</div>";
          unset($_SESSION['productDeleted']);

        }

        $rowCount = 1;

      ?>

      <h3><?php echo $componentName; ?> Products</h3><br>
            
        <table class="table">

          <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Date Created</th>
            <th>Last Edited</th>
            <th>Action</th>
          </tr>

          <?php while($row = mysqli_fetch_assoc($result)) :?>
          <tr>
            <td><?php echo $rowCount; ?></td>
            <td><a href="product_details.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['product']; ?>" class="page-link"><?php echo $row['product']; ?></a></td>
            <td><?php echo $row['dateCreated']; ?></td>
            <td><?php echo $row['lastEdited']; ?></td>
            <td>
              <a href="#" class="page-link" data-toggle="modal" data-target="#myModal-<?php echo $row['id']; ?>">Delete</a>
              <!-- Modal -->
              <div class="modal fade" id="myModal-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Delete Product: <b><?php echo $row['product']; ?></b></h4>
                    </div>
                    <div class="modal-body">
                      You are about to delete product <b><?php echo $row['product']; ?></b>. Click confirm to proceed.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <a class="btn btn-danger" href="delete_product.php?id=<?php echo $row['id']; ?>&componentID=<?php echo $componentID; ?>&componentName=<?php echo $componentName; ?>" role="button">Confirm</a>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>

          <?php 

            $rowCount++;
            endwhile;

          ?>

        </table>

        <div class="pull-right">
          <a href="add_product.php?id=<?php echo $componentID; ?>&name=<?php echo $componentName; ?>" class="btn btn-danger" role="button">Add Product</a> 
          <a href="settings.php" class="btn btn-default" role="button">Back</a>
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
