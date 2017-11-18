<?php include_once("./database/constants.php"); ?>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./includes/style.css">
    <script type="text/javascript" src="./js/main.js"></script>

  </head>
  <body>
    <div class="overlay">
      <div class="loader"></div>
    </div>

    <?php include_once "./templates/navbar.php" ?>
    <br/><br/>
    <div class="container">
      <?php
        if(isset($_GET["error"])){
          ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <?php echo $_GET["error"]; ?>
            </div>
          <?php
        }
      ?>
      
      <div class="card" style="width: 30rem;margin:0 auto;">
        <div class="card-header">Register</div>
      <div class="card-body">
        <form id="register_form" action="<?php echo DOMAIN."/includes/process.php"; ?>" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="password1">Password</label>
            <input type="password" name="password1" class="form-control"  id="password1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="password2">Re-enter Password</label>
            <input type="password" name="password2" class="form-control"  id="password2" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="usertype">Usertype</label>
            <select name="usertype" class="form-control" id="usertype">
              <option value="1">Admin</option>
              <option value="0">Other</option>
            </select>
          </div>
          <button type="submit" name="user_register" class="btn btn-primary"><span class="fa fa-user"></span>&nbsp;Register</button>
          <span><a href="index.php">Login</a></span>
        </form>
      </div>
      <div class="card-footer text-muted">
        <a href="#">forgotten password?</a>
      </div>
    </div>
    </div>
    
    
  </body>
</html>

