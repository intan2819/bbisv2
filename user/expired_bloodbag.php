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
        WHERE bloodbag.expiryDate <= now() AND bloodbag.status = 'In Stock'";
    
        $result = mysqli_query($con,$sql) or die("Cannot execute sql: ".mysqli_error($con));

        date_default_timezone_set('Asia/Kuala_Lumpur');

        $rowCount = 1;

      ?>

      <h3>Expired Bloodbag</h3><br>

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

        <div class="pull-right">
          <a class="btn btn-danger" role="button" href="#" data-toggle="modal" data-target="#discardBloodBag">Discard Bloodbag</a>
          <a href="storage_info.php" class="btn btn-default" role="button">Back</a>
        </div>

      <div class="modal fade" id="discardBloodBag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Discard Expired Bloodbag</h4>
                  </div>
                  <div class="modal-body">
                    You are about to discard all the expired bloodbag. Click confirm to proceed.
                  </div>
                  <div class="modal-footer">
                    <form method="POST" action="discard_bloodbag.php">
                      <input type="hidden" name="deleteFlag" value="expired">
                      <input type="hidden" name="remarks" value="Discard expired bloodbag">

                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-danger">Confirm</button> 
                    </form>
                  </div>
                </div>
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
