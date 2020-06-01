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

        $sql = "SELECT * FROM components";

        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        if(isset($_SESSION['addComponentSuccess'])){

          echo "<div class='alert alert-success' role='alert'>".$_SESSION['addComponentSuccess']."</div>";
          unset($_SESSION['addComponentSuccess']);

        }

        if(isset($_SESSION['componentDeleted'])){

          echo "<div class='alert alert-danger' role='alert'>".$_SESSION['componentDeleted']."</div>";
          unset($_SESSION['componentDeleted']);

        }

        $rowCount = 1;

      ?>

      <h3>Settings</h3><br>
            
        <table class="table">

          <tr>
            <th>#</th>
            <th>Component Name</th>
            <th>Shelf Life (Days)</th>
            <th>Prefix</th>
            <th>Date Created</th>
            <th>Last Edited</th>
            <th colspan="2">Action</th>
          </tr>

          <?php while($row = mysqli_fetch_assoc($result)) :?>
          <tr>
            <td><?php echo $rowCount; ?></td>
            <td><a href="products.php?id=<?php echo $row['id']; ?>&component=<?php echo $row['name']; ?>" class="page-link"><?php echo $row['name']; ?></a></td>
            <td><?php echo $row['shelfLife']; ?></td>
            <td><?php echo $row['prefix']; ?></td>
            <td><?php echo $row['dateCreated']; ?></td>
            <td><?php echo $row['lastEdited']; ?></td>
            <td><a href="edit_component.php?id=<?php echo $row['id']; ?>" class="page-link">Edit</a></td>
            <td>
              <a href="#" data-toggle="modal" data-target="#myModal-<?php echo $row['id']; ?>" class="page-link">Delete</a>
              <!-- Modal -->
              <div class="modal fade" id="myModal-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Delete Component: <b><?php echo $row['name']; ?></b></h4>
                    </div>
                    <div class="modal-body">
                      You are about to delete component <b><?php echo $row['name']; ?></b>. Click confirm to proceed.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <a class="btn btn-danger" href="delete_component.php?id=<?php echo $row['id']; ?>" role="button">Confirm</a>
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
          <a href="add_component.php" class="btn btn-danger" role="button">Add Component</a>
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
