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

        $sql = "SELECT bloodbag.id, bloodbag.displayBloodbagID, products.product, bloodbag.bloodType, donors.name, bloodbag.retrievedDate, bloodbag.expiryDate, bloodbag.dateCreated, bloodbag.lastEdited
        FROM bloodbag LEFT JOIN products
        ON bloodbag.productID = products.id
        LEFT JOIN donors ON bloodbag.donorID = donors.id
        WHERE bloodbag.expiryDate <= now() AND bloodbag.status = 'In Stock'
        LIMIT 10";
    
        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        date_default_timezone_set('Asia/Kuala_Lumpur');

        $rowCount = 1;


        $sql_a = "SELECT products.id, products.product, notifications.typeAcount, COUNT(CASE WHEN bloodbag.status = 'In Stock' AND bloodbag.bloodType = 'A' THEN 1 END) AS productNum
        FROM products LEFT JOIN bloodbag
        ON products.id = bloodbag.productID
        LEFT JOIN notifications ON products.id = notifications.productID
        GROUP BY products.id
        HAVING productNum <= notifications.typeAcount";

        $result_a = mysqli_query($con,$sql_a) or die("Cannot execute sql: ".mysqli_error($con));

        $rowCount_a = 1;


        $sql_b = "SELECT products.id, products.product, notifications.typeBcount, COUNT(CASE WHEN bloodbag.status = 'In Stock' AND bloodbag.bloodType = 'B' THEN 1 END) AS productNum
        FROM products LEFT JOIN bloodbag
        ON products.id = bloodbag.productID
        LEFT JOIN notifications ON products.id = notifications.productID
        GROUP BY products.id
        HAVING productNum <= notifications.typeBcount";

        $result_b = mysqli_query($con,$sql_b) or die("Cannot execute sql: ".mysqli_error($con));

        $rowCount_b = 1;


        $sql_o = "SELECT products.id, products.product, notifications.typeOcount, COUNT(CASE WHEN bloodbag.status = 'In Stock' AND bloodbag.bloodType = 'O' THEN 1 END) AS productNum
        FROM products LEFT JOIN bloodbag
        ON products.id = bloodbag.productID
        LEFT JOIN notifications ON products.id = notifications.productID
        GROUP BY products.id
        HAVING productNum <= notifications.typeOcount";

        $result_o = mysqli_query($con,$sql_o) or die("Cannot execute sql: ".mysqli_error($con));

        $rowCount_o = 1;


        $sql_ab = "SELECT products.id, products.product, notifications.typeABcount, COUNT(CASE WHEN bloodbag.status = 'In Stock' AND bloodbag.bloodType = 'AB' THEN 1 END) AS productNum
        FROM products LEFT JOIN bloodbag
        ON products.id = bloodbag.productID
        LEFT JOIN notifications ON products.id = notifications.productID
        GROUP BY products.id
        HAVING productNum <= notifications.typeABcount";

        $result_ab = mysqli_query($con,$sql_ab) or die("Cannot execute sql: ".mysqli_error($con));

        $rowCount_ab = 1;

      ?>

      <h3>Storage Info</h3><br>

      <div class="panel panel-danger">
        <div class="panel-heading">Expired Bloodbag (<?php echo date("d-m-Y H:i:s"); ?>)</div>
        <div class="panel-body">
          <?php if(mysqli_num_rows($result) != 0): ?>
          <table class="table">

          <tr>
            <th>#</th>
            <th>ID</th>
            <th>Product</th>
            <th>Blood Type</th>
            <th>Donor Name</th>
            <th>Retrieved Date</th>
            <th>Expiry Date</th>
            <th>Date Created</th>
            <th>Last Edited</th>
          </tr>

          <?php while($row = mysqli_fetch_assoc($result)) :?>
          <tr>
            <td><?php echo $rowCount; ?></td>
            <td><?php echo $row['displayBloodbagID']; ?></td>
            <td><?php echo $row['product']; ?></td>
            <td><?php echo $row['bloodType']; ?></td>
            <td><?php echo $row['name'];; ?></td>
            <td><?php echo $row['retrievedDate']; ?></td>
            <td><?php echo $row['expiryDate']; ?></td>
            <td><?php echo $row['dateCreated']; ?></td>
            <td><?php echo $row['lastEdited']; ?></td>
          </tr>

          <?php

            $rowCount++;
            endwhile;

          ?>

        </table>

        <br>

        <div class="pull-right"><a href="expired_bloodbag.php">See More</a></div>
        <?php endif; ?>

        <?php if(mysqli_num_rows($result) == 0){

          echo "No expired bloodbag";

          }

        ?>
        </div>
      </div>

      <div class="panel panel-danger">
        <div class="panel-heading">Stock Is Running Low (<?php echo date("d-m-Y H:i:s"); ?>)</div>
        <div class="panel-body">

          <table class="table">

            <caption class="table-caption">Blood Type A</caption>

            <tr>
              <th>#</th>
              <th>Product</th>
              <th>Current No. Of Supply</th>
              <th>Min No. Of Supply</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result_a)) :?>
            <tr>
              <td><?php echo $rowCount_a; ?></td>
              <td><?php echo $row['product']; ?></td>
              <td><?php echo $row['productNum']; ?></td>
              <td><?php echo $row['typeAcount'];; ?></td>
            </tr>

            <?php

              $rowCount_a++;
              endwhile;

            ?>

          </table>

          <table class="table">

            <caption class="table-caption">Blood Type B</caption>

            <tr>
              <th>#</th>
              <th>Product</th>
              <th>Current No. Of Supply</th>
              <th>Min No. Of Supply</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result_b)) :?>
            <tr>
              <td><?php echo $rowCount_b; ?></td>
              <td><?php echo $row['product']; ?></td>
              <td><?php echo $row['productNum']; ?></td>
              <td><?php echo $row['typeBcount'];; ?></td>
            </tr>

            <?php

              $rowCount_b++;
              endwhile;

            ?>

          </table>

          <table class="table">

            <caption class="table-caption">Blood Type O</caption>

            <tr>
              <th>#</th>
              <th>Product</th>
              <th>Current No. Of Supply</th>
              <th>Min No. Of Supply</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result_o)) :?>
            <tr>
              <td><?php echo $rowCount_o; ?></td>
              <td><?php echo $row['product']; ?></td>
              <td><?php echo $row['productNum']; ?></td>
              <td><?php echo $row['typeOcount'];; ?></td>
            </tr>

            <?php

              $rowCount_o++;
              endwhile;

            ?>

          </table>

          <table class="table">

            <caption class="table-caption">Blood Type AB</caption>

            <tr>
              <th>#</th>
              <th>Product</th>
              <th>Current No. Of Supply</th>
              <th>Min No. Of Supply</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result_ab)) :?>
            <tr>
              <td><?php echo $rowCount_ab; ?></td>
              <td><?php echo $row['product']; ?></td>
              <td><?php echo $row['productNum']; ?></td>
              <td><?php echo $row['typeABcount'];; ?></td>
            </tr>

            <?php

              $rowCount_ab++;
              endwhile;

            ?>

          </table>
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