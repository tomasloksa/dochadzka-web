<?php
// Include config file
require "model/Db.php";
require "model/User.php";
require "model/UserStorage.php";

$storage = new UserStorage();
$users = $storage->getAll();
$page = basename($_SERVER['PHP_SELF']);
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Define variables and initialize with empty values
$surname = $password = "";
$surname_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pdo = DB::conn();
    // Check if surname is empty
    if(empty(trim($_POST["surname"]))){
        $surname_err = "Please enter surname.";
    } else{
        $surname = trim($_POST["surname"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($surname_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, surname, password FROM users WHERE surname = :surname";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":surname", $param_surname, PDO::PARAM_STR);
            
            // Set parameters
            $param_surname = trim($_POST["surname"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if surname exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $surname = $row["surname"];
                        $hashed_password = $row["password"];
                        //if(password_verify($password, $hashed_password)){
                          if($password == $hashed_password) {
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["surname"] = $surname;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid surname or password.";
                        }
                    }
                } else{
                    // surname doesn't exist, display a generic error message
                    $login_err = "Invalid surname or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
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

<!-- Modal -->
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