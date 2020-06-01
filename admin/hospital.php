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
    <script type="text/javascript">
      input.setAttribute('size',input.getAttribute('placeholder').length);
    </script>

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

        $sql = "SELECT * FROM hospitals ORDER BY id ASC";
    
        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        if(isset($_SESSION['hospitalRegistrationSuccess'])){

          echo "<div class='alert alert-success' role='alert'>".$_SESSION['hospitalRegistrationSuccess']."</div>";
          unset($_SESSION['hospitalRegistrationSuccess']);

        }

        if(isset($_SESSION['hospitalDeleted'])){

          echo "<div class='alert alert-danger' role='alert'>".$_SESSION['hospitalDeleted']."</div>";
          unset($_SESSION['hospitalDeleted']);

        }

        $count = 1;

      ?>

      <h3>Hospitals</h3>

      <div class="pull-right">
        <form class="form-inline" method="POST" action="search_hospital.php">
          <div class="input-group">
            <input type="text" class="form-control" name="keyword" required>
            <span class="input-group-btn">
              <button class="btn btn-danger" type="submit">Search Hospital</button>
            </span>
          </div>

          <a class="btn btn-danger" href="register_hospital.php" role="button">New Hospital</a>

        </form>
      </div>

      <div class="table-container">

        <table class="table">

          <thead>
            <tr>
            <th>No.</th>
            <th>Hospital Name</th>
            <th>Address</th>
            <th>Telephone Number</th>
            <th>Fax</th>
            <th>Email</th>
            <th>Date Registered</th>
            <th>Last Updated</th>
            <th colspan="2">Action</th>
            </tr>
          </thead>
        
          <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) :?>
            <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row['hospitalName']; ?></td>
            <td>
              <?php echo $row['address']; ?><br>
              <?php echo $row['postcode'].' '.$row['town']; ?><br>
              <?php echo $row['state']; ?>
            </td>
            <td><?php echo $row['phoneNumber']; ?></td>
            <td><?php echo $row['fax']; ?></td>
            <td><?php echo $row['emailAddress']; ?></td>
            <td><?php echo $row['dateRegistered']; ?></td>
            <td><?php echo $row['lastUpdated']; ?></td>
            <td><a href="edit_hospital.php?id=<?php echo $row['id']; ?>" class="page-link">Edit</a></td>
            <td>
              <a href="#" class="page-link" data-toggle="modal" data-target="#myModal-<?php echo $row['id']; ?>">Delete</a>
              <!-- Modal -->
              <div class="modal fade" id="myModal-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Delete Hospital: <b><?php echo $row['hospitalName']; ?></b></h4>
                    </div>
                    <div class="modal-body">
                      You are about to delete <b><?php echo $row['hospitalName']; ?></b> from BBIS hospital list. Click confirm to proceed.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <a class="btn btn-danger" href="delete_hospital.php?id=<?php echo $row['id']; ?>" role="button">Confirm</a>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            </tr>
            <?php 
              
              endwhile;
              $count++;

            ?>   
          </tbody>

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
    <!--<script type="text/javascript">
      input.setAttribute('size',input.getAttribute('placeholder').length);
    </script>-->
  </body>
</html>
