
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Inventory System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="index.php"> <span class="fa fa-home">&nbsp;</span>Home <span class="sr-only">(current)</span></a>
        </li>
        
          <?php if (isset($_SESSION["user_id"])) {
            ?>
            <li class="nav-item">
              <a class="nav-link active" href="logout.php"><span class="fa fa-user">&nbsp;</span>Logout</a>
            </li>
            <?php
          } 
          ?>
        
        
      </ul>
    </div>
  </nav>




