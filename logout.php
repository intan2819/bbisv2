<?php

  if(isset($_POST['logout'])){

  	session_start();
  	session_destroy();
  	header("location:login.php");

  }

?>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="\bbisv2\logout.php" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">You Had Chosen To Logout</h4>
                  </div>
      <div class="modal-body">
        After logging out you will have to log in again to access the system. Click 'Logout' to proceed.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <!--<a class="btn btn-danger" href="/bbisv2/logout.php" role="button" name="logout">Logout</a>-->
        <button type="submit" class="btn btn-danger" name="logout">Logout</button>
      </div>
  	</form>
    </div>
  </div>
</div>