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

        $componentID = $_GET['id'];

        $sql1 = "SELECT * FROM components WHERE id = $componentID";

        $result1 = mysqli_query($con,$sql1) or die("Cannot execute sql: ".mysqli_error($con));

        $componentData = mysqli_fetch_assoc($result1);

        $sql2 = "SELECT products.id, products.product, COUNT(CASE WHEN bloodbag.status = 'In Stock' THEN 1 END) AS numOfBloodBag
          FROM products LEFT JOIN bloodbag
          ON products.id = bloodbag.productID
          WHERE products.componentID = $componentID
          GROUP BY products.id";

        $result2 = mysqli_query($con,$sql2) or die("Cannot execute sql: ".mysqli_error($con));

        $rowCount = 1;

      ?>

      <h3>Product Inventory</h3><br>

        <div class="row">
          <div class="col-md-2"><b>Component</b>:</div>
          <div class="col-md-10"><?php echo $componentData['name'] ?></div>
        </div>
        <div class="row">
          <div class="col-md-2"><b>Shelf Life</b>:</div>
          <div class="col-md-10"><?php echo $componentData['shelfLife'] ?></div>
        </div>

        <br>
            
        <table class="table">

          <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Count</th>
          </tr>

          <?php while($row = mysqli_fetch_assoc($result2)) :?>
          <tr>
            <td><?php echo $rowCount; ?></td>
            <td><a href="bloodbag.php?id=<?php echo $row['id']; ?>"><?php echo $row['product']; ?></a></td>
            <td><?php echo $row['numOfBloodBag']; ?></td>
          </tr>

          <?php

            $rowCount++;
            endwhile;

          ?>

        </table>

        <div class="pull-right">
          <a href="inventory.php" class="btn btn-default" role="button">Back</a>
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
