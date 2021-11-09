<div class="title">
  <h1 class="heading">Dochádzkový systém</h1>
</div>

<nav class="navbar navbar-expand-sm navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mt-2 mt-lg-0">
      <li class="nav-item <?php if($page == 'index.php'){ echo ' active"';}?>">
        <a href="index.php" class="nav-link">Domov</a>
      </li>
      <li class="nav-item <?php if($page == 'download.php'){ echo ' active"';}?>">
        <a href="download.php" class="nav-link">Na Stiahnutie</a>
      </li>
      <li class="nav-item <?php if($page == 'news.php'){ echo ' active"';}?>">
        <a href="news.php" class="nav-link">Novinky</a>
      </li>
      <li class="nav-item <?php if($page == 'contact.php'){ echo ' active"';}?>">
        <a href="contact.php" class="nav-link">Kontakt</a>
      </li>
    </ul>
    <a class="btn btn-primary btn-lg" href="login.php">Prihlásenie</a>
  </div>
</nav>

<!-- Modal, ktory sa zatial nepouziva!!! -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Prihlásenie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2>Prihlásenie</h2>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form name="login" id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="form-group">
              <label>Login</label>
              <input type="text" name="surname" class="form-control <?php echo (!empty($surname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $surname; ?>">
              <span class="invalid-feedback"><?php echo $surname_err; ?></span>
          </div>    
          <div class="form-group">
              <label>Heslo</label>
              <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
              <span class="invalid-feedback"><?php echo $password_err; ?></span>
          </div>
          <button type="submit" class="btn btn-primary" value="Login">Prihlásenie</button>
        </form>
    </div>
    </div>
  </div>
</div>

<script type = "text/javascript">  
  $('#exampleModal').on('hide.bs.modal', function (event) {
    console.log('snazim sa fungovat');
    event.preventDefault();
    event.stopPropagation();
  })
</script>