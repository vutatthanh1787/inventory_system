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
        <div class="col-md-4">
          <div class="card">
            <img class="card-img-top" style="width:60%;margin:0 auto;" src="./images/user.png" alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title">Profile</h4>
              <p class="card-text"><span class="fa fa-user">&nbsp;</span><?php echo $_SESSION["username"]; ?></p>
              <p class="card-text"><span class="fa fa-user">&nbsp;</span>Admin</p>
              <p class="card-text"><span class="fa fa-clock-o">&nbsp;</span>Last login : <?php echo $_SESSION["last_login"]; ?></p>
              <a href="#" class="btn btn-primary"><i class="fa fa-pencil">&nbsp;</i>Edit Profile</a>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="jumbotron" style="width:100%;height:100%;">
            <h1>Welcome Admin,</h1><small>Have a nice day</small>
            <div class="row">
              <div class="col-sm-6">
                <p></p>
                 <iframe src="http://free.timeanddate.com/clock/i5xp589c/n1868/szw160/szh160/cf100/hnce1ead6" frameborder="0" width="160" height="160"></iframe>

              </div>
              <div class="col-sm-6">
                <div class="card" style="width: 20rem;">
                  <div class="card-body">
                    <h4 class="card-title">Orders</h4>
                    <p class="card-text">Here you can make a new Order and print invoices</p>
                    <a href="new_order.php" class="btn btn-primary">New Order</a>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </div>
    <p></p>
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Category</h4>
              <p class="card-text">Here you can add and manage categories </p>
              <a href="#" data-toggle="modal" data-target="#add_category" class="btn btn-info"><span class="fa fa-plus">&nbsp;</span>Add</a>
              <a href="manage_category.php" class="btn btn-success"><span class="fa fa-pencil-square-o">&nbsp;</span>Manage</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Brands</h4>
              <p class="card-text">Here you can add and manage Brands</p>
              <a href="#" data-toggle="modal" data-target="#add_brand" class="btn btn-info"><span class="fa fa-plus">&nbsp;</span>Add</a>
              <a href="manage_brand.php" class="btn btn-success"><span class="fa fa-square-o">&nbsp;</span>Manage</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Products</h4>
              <p class="card-text">Here you can add and manage products</p>
              <a href="#" data-toggle="modal" data-target="#add_product" class="btn btn-info"><span class="fa fa-plus">&nbsp;</span>Add</a>
              <a href="manage_product.php" class="btn btn-success"><span class="fa fa-pencil-square-o">&nbsp;</span>Manage</a>
            </div>
          </div>
        </div>
      </div>
    </div>



     <?php 
        //Here a model for add brand is included
        include "./templates/add_brand.php";
     ?>

      <?php 
        //Here a model for add Category is included
        include "./templates/add_category.php";
     ?>


      <?php 
        //Here a model for add Product is included
        include "./templates/add_product.php";
     ?>


  </body>
</html>
