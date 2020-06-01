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

        $productID = $_GET['id'];

        $sql = "SELECT * FROM products WHERE id = $productID";

        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        $productData = mysqli_fetch_assoc($result);

        $sql2 = "SELECT * FROM donors";

        $result2 = mysqli_query($con,$sql2) or die("Cannot execute sql: ".mysqli_error($con));

      ?>

      <form method="POST" action="add_bloodbag_process.php">

        <input type="hidden" name="productID" value="<?php echo $productID; ?>">

        <div class="form-group">
          <label>Product</label>
          <input type="text" class="form-control" value="<?php echo $productData['product'] ?>" disabled>
        </div>

        <div class="form-group">
          <label>Blood Type</label>
            <select class="form-control" name="bloodType" required>
              <option value="" selected disabled>Select Blood Type</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="O">O</option>
              <option value="AB">AB</option>
            </select>
        </div>

        <div class="form-group">
          <label>Donor</label>
            <select class="form-control" name="donorID" required>
              <option value="" selected disabled>Select Donor</option>
              <?php while($row = mysqli_fetch_assoc($result2)) :?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
              <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
          <label>Retrieve Date</label>
          <input type="date" class="form-control" placeholder="Date Retrieved" name="retrievedDate" required>
        </div>

        <small><b><span style='color:red'>*</span>Note: Please make sure all the details are correct before submit</b></small>

        <div class="pull-right">
          <button type="submit" class="btn btn-danger">Add</button> 
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