<?php include_once("./database/db.php");
if (isset($_SESSION["user_id"])) {
   header("location:".DOMAIN."/dashboard.php");
 } ?>
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
    <link rel="stylesheet" type="text/css" href="./includes/style.css">
    <!-- <script type="text/javascript" src="./js/main.js"></script> -->
    <script type="text/javascript" src="./js/ajax_process.js"></script>

  </head>
  <body>
    <div class="overlay"><div class="loader"></div></div>

    <?php include_once "./templates/navbar.php" ?>
    <br/><br/>
    <div class="container">
      <?php
        if(isset($_GET["success"])){
          ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <?php echo $_GET["success"]; ?>
            </div>
          <?php
        }
      ?>
      <div class="card" style="width: 20rem;margin:0 auto;">
      <img class="card-img-top" style="width:60%; margin:0 auto;" src="./images/login.png" alt="Card image cap">
      <div class="card-body">
        <form id="login_form" onsubmit="return false" autocomplete="off">
          <div class="form-group">
            <label for="log_email">Email address</label>
            <input type="email" name="log_email" class="form-control" id="log_email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="e-error" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="log_password">Password</label>
            <input type="password" name="log_password" class="form-control"  id="log_password" placeholder="Password">
            <small id="p-error" class="form-text text-muted"></small>
          </div>
          <button type="submit" name="login" class="btn btn-primary"><span class="fa fa-user"></span>&nbsp;Login</button>
          <span><a href="register.php">Register</a></span>
        </form>
      </div>
      <div class="card-footer text-muted">
        <a href="#">forgotten password?</a>
      </div>
    </div>
    </div>
    
    
  </body>
</html>