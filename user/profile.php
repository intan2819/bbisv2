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

        $id = $_SESSION['userid'];

        include ('../config.php');

        $sql = "SELECT * FROM users WHERE id = $id";
    
        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        while($row = mysqli_fetch_assoc($result)){

          $name = $row['name'];
          $username = $row['username'];
          $icNumber = $row['icNumber'];
          $gender = $row['gender'];
          $phoneNumber = $row['phoneNumber'];
          $emailAddress = $row['emailAddress'];
          $role = $row['role'];
          $dateRegistered = $row['dateRegistered'];
          $lastUpdated = $row['lastUpdated'];
  
        }

      ?>

      <h3>User Profile</h3>

      <div class="info-display">

        <div class="row">
          <div class="col-md-2"><b>Name</b>:</div>
          <div class="col-md-4"><?php echo $name; ?></div>
        </div>

        <div class="row">
          <div class="col-md-2"><b>Username</b>:</div>
          <div class="col-md-4"><?php echo $username; ?></div>
        </div>

        <div class="row">
          <div class="col-md-2"><b>I/C Number</b>:</div>
          <div class="col-md-4"><?php echo $icNumber; ?></div>
        </div>

        <div class="row">
          <div class="col-md-2"><b>Gender</b>:</div>
          <div class="col-md-4"><?php echo $gender; ?></div>
        </div>

        <div class="row">
          <div class="col-md-2"><b>Phone Number</b>:</div>
          <div class="col-md-4"><?php echo $phoneNumber; ?></div>
        </div>

        <div class="row">
          <div class="col-md-2"><b>Email Address</b>:</div>
          <div class="col-md-4"><?php echo $emailAddress; ?></div>
        </div>

        <div class="row">
          <div class="col-md-2"><b>Password</b>:</div>
          <div class="col-md-4">*******[<a href="change_password.php" class="page-link">Change Password</a>]</div>
        </div>

        <div class="row">
          <div class="col-md-2"><b>Role</b>:</div>
          <div class="col-md-4"><?php echo ucfirst($role); ?></div>
        </div>

        <div class="row">
          <div class="col-md-2"><b>Date Registered</b>:</div>
          <div class="col-md-4"><?php echo $dateRegistered; ?></div>
        </div>

        <div class="row">
          <div class="col-md-2"><b>Last Updated</b>:</div>
          <div class="col-md-4"><?php echo $lastUpdated; ?></div>
        </div>

        <div class="pull-right">
          <a href="edit_profile.php" class="btn btn-danger" role="button">Update Profile</a>
          <a href="storage_info.php" class="btn btn-default" role="button">Back</a>
        </div>

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
