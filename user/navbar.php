<?php

  session_start();

  if(!isset($_SESSION['role'])){

    header("location:/bbisv2/login.php");

  }elseif($_SESSION['role'] != 'user'){

    header("location:/bbisv2/admin/user.php");

  }

?>

<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" id="navbar-link" href="storage_info.php">Blood Bank Inventory System</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="storage_info.php">Storage Info</a></li>
            <li><a href="inventory.php">Inventory</a></li>
            <li><a href="transaction.php">Transaction</a></li>
            <li><a href="donor.php">Donor</a></li>
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Profile</a></li>
                <li><a href="#">Inventory</a></li>
              </ul>
            </li>-->
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="#" data-toggle="modal" data-target="#logoutModal">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
</nav>