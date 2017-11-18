<?php 
include_once("./database/db.php");
include_once("./includes/DBOperation.php");
if (!isset($_SESSION["user_id"])) {
  header("location:".DOMAIN."/");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script type="text/javascript" src="./js/main.js"></script> -->
    <script type="text/javascript" src="./js/ajax_process.js"></script>

  </head>
  <body>

    <?php include_once "./templates/navbar.php" ?>
    <br/><br/>

    <div class="container">
      <div class="row">
        <h2>Manage Brands</h2>
        <div class="col-md-12">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Brand Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="get_brand">


              <!--Brand information will fetch here from PHP Script process.php-->
              
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <?php 
        //Here a model for update brand is included
        include "./templates/update_brand.php";
     ?>

  </body>
</html>
<script type="text/javascript">
$(document).ready(function(){


 
})

</script>