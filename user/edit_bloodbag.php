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

        $bloodbagID = $_GET['id'];

        $sql = "SELECT * FROM bloodbag WHERE id = $bloodbagID";

        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        while($row = mysqli_fetch_assoc($result)){

          $productID = $row['productID'];
          $bloodType = $row['bloodType'];
          $donorID = $row['donorID'];
          $retrievedDate = $row['retrievedDate'];
  
        }

        $sql2 = "SELECT * FROM donors";

        $result2 = mysqli_query($con,$sql2) or die("Cannot execute sql: ".mysqli_error($con));

        $sql3 = "SELECT * FROM products";

        $result3 = mysqli_query($con,$sql3) or die("Cannot execute sql: ".mysqli_error($con));

        if(isset($_SESSION['bloodbagEditSuccess'])){

          echo "<div class='alert alert-success' role='alert'>".$_SESSION['bloodbagEditSuccess']."</div>";
          unset($_SESSION['bloodbagEditSuccess']);

        }

      ?>

      <form method="POST" action="edit_bloodbag_process.php">

        <input type="hidden" name="id" value="<?php echo $bloodbagID; ?>">

        <div class="form-group">
          <label>Product</label>
            <select class="form-control" name="productID" required>
              <option value="" selected disabled>Select Product</option>
              <?php while($row = mysqli_fetch_assoc($result3)) :?>
                <option value="<?php echo $row['id']; ?>" <?php if($productID == $row['id']){echo 'selected';} ?>><?php echo $row['product']; ?></option>
              <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
          <label for="bloodType">Blood Type</label>
            <select class="form-control" name="bloodType">
              <option value="A" <?php if($bloodType == 'A'){echo 'selected';} ?>>A</option>
              <option value="B" <?php if($bloodType == 'B'){echo 'selected';} ?>>B</option>
              <option value="O" <?php if($bloodType == 'O'){echo 'selected';} ?>>O</option>
              <option value="AB" <?php if($bloodType == 'AB'){echo 'selected';} ?>>AB</option>
            </select>
        </div>

        <div class="form-group">
          <label>Donor</label>
            <select class="form-control" name="donorID" required>
              <option value="" selected disabled>Select Donor</option>
              <?php while($row = mysqli_fetch_assoc($result2)) :?>
                <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $donorID){echo 'selected';} ?>><?php echo $row['name']; ?></option>
              <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
          <label>Retrieve Date</label>
          <input type="date" class="form-control" placeholder="Date Retrieved" name="retrievedDate" value="<?php echo $retrievedDate; ?>" required>
        </div>

        <small><b><span style='color:red'>*</span>Note: Please make sure all the details are correct before submit</b></small>

        <div class="pull-right">
          <button type="submit" class="btn btn-danger">Update</button> 
          <a href="bloodbag.php?id=<?php echo $productID; ?>" class="btn btn-default" role="button">Cancel</a>
        </div>

      </form>

      

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