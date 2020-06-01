<?php

  session_start();

  if(!isset($_SESSION['role'])){

    header("location:/bbisv2/login.php");

  }elseif($_SESSION['role'] != 'admin'){

    header("location:/bbisv2/user/home.php");

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
          <a class="navbar-brand" id="navbar-link" href="user.php">Blood Bank Inventory System</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="user.php">Users</a></li>
            <li><a href="hospital.php">Hospitals</a></li>
            <li><a href="settings.php">Settings</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" data-toggle="modal" data-target="#logoutModal">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
</nav>