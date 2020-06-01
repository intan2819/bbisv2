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

        $id = $_GET["id"];
  
        $sql = "SELECT * FROM users WHERE id = '$id'";

        $result = mysqli_query($con, $sql) or die("Cannot execute sql" .mysqli_error($con));
 
        while($row = mysqli_fetch_assoc($result)){

          $id = $row['id'];
          $name = $row['name'];
          $icNumber = $row['icNumber'];
          $gender = $row['gender'];
          $phoneNumber = $row['phoneNumber'];
          $emailAddress = $row['emailAddress'];
          $username = $row['username'];
          $password = $row['password'];
          $role = $row['role'];
  
        }

        if(isset($_SESSION['userEditSuccess'])){

          echo "<div class='alert alert-success' role='alert'>".$_SESSION['userEditSuccess']."</div>";
          unset($_SESSION['userEditSuccess']);

        }

      ?>

      <h3>Edit User Details</h3>

      <form method="POST" action="edit_user_process.php" class="form-style">

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Full Name" name="name" value="<?php echo $name; ?>" required>
        </div>

        <div class="form-group">
          <label for="icNumber">I/C Number</label>
          <input type="text" class="form-control" maxlength="12" id="icNumber" placeholder="I/C Number" name="icNumber" value="<?php echo $icNumber; ?>" required>
        </div>


        <div class="form-group">
          <label for="phoneNumber">Gender</label>&emsp;
            <label class="radio-inline">
              <input type="radio" name="gender" id="gender" value="Male" <?php if($gender == 'Male'){echo "checked='checked'";} ?>> Male
            </label>
          <label class="radio-inline">
            <input type="radio" name="gender" id="gender" value="Female" <?php if($gender == 'Female'){echo "checked='checked'";} ?>> Female
          </label>
        </div>

        <div class="form-group">
          <label for="phoneNumber">Phone Number</label>
          <input type="text" class="form-control" id="phoneNumber" placeholder="Phone Number" name="phoneNumber" value="<?php echo $phoneNumber; ?>" required>
        </div>

        <div class="form-group">
          <label for="emailAddress">Email</label>
          <input type="email" class="form-control" id="emailAddress" placeholder="Email Address" name="emailAddress" value="<?php echo $emailAddress; ?>" required>
        </div>

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?php echo $password; ?>" required>
        </div>

        <div class="form-group">
          <label for="role">Role</label>
            <select class="form-control" name="role">
              <option value="admin" <?php if($role == 'admin'){echo "selected='selected'";} ?>>Admin</option>
              <option value="user" <?php if($role == 'user'){echo "selected='selected'";} ?>>User</option>
            </select>
        </div>

        <small><b><span style='color:red'>*</span>Note: Please make sure all the details are correct before submit</b></small>

        <div class="pull-right">
          <button type="submit" class="btn btn-danger">Update</button> 
          <a href="user.php" class="btn btn-default" role="button">Back</a>
        </div>

      </form>

      <br/>

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
