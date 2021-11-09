<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="sk">
<head>
  <?php include("shared/head.html"); ?>
</head>
<body>
  <header>
    <?php include("shared/portalHeader.php"); ?>
	</header>

  <p>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</p>
</body>
</html>