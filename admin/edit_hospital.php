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
  
        $sql = "SELECT * FROM hospitals WHERE id = '$id'";

        $result = mysqli_query($con, $sql) or die("Cannot execute sql" .mysqli_error($con));
 
        while($row = mysqli_fetch_assoc($result)){

          $id = $row['id'];
          $hospitalName = $row['hospitalName'];
          $address = $row['address'];
          $town = $row['town'];
          $state = $row['state'];
          $postcode = $row['postcode'];
          $phoneNumber = $row['phoneNumber'];
          $fax = $row['fax'];
          $emailAddress = $row['emailAddress'];
  
        }

        if(isset($_SESSION['hospitalEditSuccess'])){

          echo "<div class='alert alert-success' role='alert'>".$_SESSION['hospitalEditSuccess']."</div>";
          unset($_SESSION['hospitalEditSuccess']);

        }

      ?>

      <h3>Edit Hospital Details</h3>

      <form method="POST" action="edit_hospital_process.php" class="form-style">

        <input type="hidden" name="id" value="<?php echo $id ?>" >

        <div class="form-group">
          <label for="name">Hospital Name</label>
          <input type="text" class="form-control" id="name" placeholder="Hospital Name" name="name" value="<?php echo $hospitalName; ?>" required>
        </div>

        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="<?php echo $address; ?>" required>
        </div>

        <div class="form-group">
          <label for="town">Town</label>
          <input type="text" class="form-control" id="town" placeholder="Town" name="town" value="<?php echo $town; ?>" required>
        </div>

        <div class="form-group">
          <label for="state">State</label>
            <select class="form-control" name="state">
              <option value="" disabled selected>Select State</option>
              <option value="Johor" <?php if($state == 'Johor'){echo "selected='selected'";} ?>>Johor</option>
              <option value="Kedah" <?php if($state == 'Kedah'){echo "selected='selected'";} ?>>Kedah</option>
              <option value="Kelantan" <?php if($state == 'Kelantan'){echo "selected='selected'";} ?>>Kelantan</option>
              <option value="Melaka" <?php if($state == 'Melaka'){echo "selected='selected'";} ?>>Melaka</option>
              <option value="Negeri Sembilan" <?php if($state == 'Negeri Sembilan'){echo "selected='selected'";} ?>>Negeri Sembilan</option>
              <option value="Pahang" <?php if($state == 'Pahang'){echo "selected='selected'";} ?>>Pahang</option>
              <option value="Perak" <?php if($state == 'Perak'){echo "selected='selected'";} ?>>Perak</option>
              <option value="Perlis" <?php if($state == 'Perlis'){echo "selected='selected'";} ?>>Perlis</option>
              <option value="Pulau Pinang" <?php if($state == 'Pulau Pinang'){echo "selected='selected'";} ?>>Pulau Pinang</option>
              <option value="Sabah" <?php if($state == 'Sabah'){echo "selected='selected'";} ?>>Sabah</option>
              <option value="Sarawak" <?php if($state == 'Sarawak'){echo "selected='selected'";} ?>>Sarawak</option>
              <option value="Selangor" <?php if($state == 'Selangor'){echo "selected='selected'";} ?>>Selangor</option>
              <option value="Terengganu" <?php if($state == 'Terengganu'){echo "selected='selected'";} ?>>Terengganu</option>
              <option value="W.P Kuala Lumpur" <?php if($state == 'W.P Kuala Lumpur'){echo "selected='selected'";} ?>>W.P Kuala Lumpur</option>
              <option value="W.P Labuan" <?php if($state == 'W.P Labuan'){echo "selected='selected'";} ?>>W.P Labuan</option>
              <option value="W.P Putrajaya" <?php if($state == 'W.P Putrajaya'){echo "selected='selected'";} ?>>W.P Putrajaya</option>
            </select>
        </div>

        <div class="form-group">
          <label for="postcode">Postcode</label>
          <input type="number" max="99999" class="form-control" id="postcode" placeholder="Postcode" name="postcode" value="<?php echo $postcode; ?>" required>
        </div>

        <div class="form-group">
          <label for="phoneNumber">Phone Number</label>
          <input type="text" class="form-control" id="phoneNumber" placeholder="Phone Number" name="phoneNumber" maxlength="15" value="<?php echo $phoneNumber; ?>" required>
        </div>

        <div class="form-group">
          <label for="fax">Fax</label>
          <input type="text" class="form-control" id="fax" placeholder="Fax Number" name="fax" maxlength="15" value="<?php echo $fax; ?>" required>
        </div>

        <div class="form-group">
          <label for="emailAddress">Email</label>
          <input type="email" class="form-control" id="emailAddress" placeholder="Email Address" name="emailAddress" value="<?php echo $emailAddress; ?>" required>
        </div>

        <small><b><span style='color:red'>*</span>Note: Please make sure all the details are correct before submit</b></small>

        <div class="pull-right">
          <button type="submit" class="btn btn-danger">Update</button> 
          <a href="hospital.php" class="btn btn-default" role="button">Back</a>
        </div>

      </form>

      <br><br>

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
