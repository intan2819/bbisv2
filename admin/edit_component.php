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
  
        $sql = "SELECT * FROM components WHERE id = '$id'";

        $result = mysqli_query($con, $sql) or die("Cannot execute sql" .mysqli_error($con));
 
        while($row = mysqli_fetch_assoc($result)){

          $id = $row['id'];
          $name = $row['name'];
          $shelfLife = $row['shelfLife'];
          $prefix = $row['prefix'];
          
        }

        if(isset($_SESSION['componentEditSuccess'])){

          echo "<div class='alert alert-success' role='alert'>".$_SESSION['componentEditSuccess']."</div>";
          unset($_SESSION['componentEditSuccess']);

        }

      ?>

      <h3>Edit Component Details</h3>

      <div class="form-style">

        <form method="POST" action="edit_component_process.php">

          <input type="hidden" name="id" value="<?php echo $id; ?>">

          <div class="form-group">
            <label for="name">Component Name</label>
            <input type="text" class="form-control" placeholder="Component Name" name="name" value="<?php echo $name; ?>" required>
          </div>

          <div class="form-group">
            <label for="shelfLife">Shelf Life (Days)</label>
            <input type="number" class="form-control" placeholder="Shelf Life" name="shelfLife" value="<?php echo $shelfLife; ?>" required>
          </div>

          <div class="form-group">
            <label for="prefix">Prefix</label>
            <input type="text" class="form-control" placeholder="Prefix used as part of bloodbag ID for component identification" maxlength="3" name="prefix" value="<?php echo $prefix; ?>" required>
          </div>

          <div class="pull-right">
            <button type="submit" class="btn btn-danger">Save Changes</button> 
            <a href="settings.php" class="btn btn-default" role="button">Back</a>
          </div>

        </form>

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
