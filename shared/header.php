<?php
  $page = basename($_SERVER['PHP_SELF']);
?>

<div class="title">
  <h1 class="heading">Dochádzkový systém</h1>
</div>

<div class="w3-bar navbar">
  <a href="index.php" class="w3-bar-item <?php if($page == 'index.php'){ echo ' active"';}?>">Domov</a>
  <a href="download.php" class="w3-bar-item w3-hide-small <?php if($page == 'download.php'){ echo ' active"';}?>">Na Stiahnutie</a>
  <a href="news.php" class="w3-bar-item w3-hide-small <?php if($page == 'news.php'){ echo ' active"';}?>">Novinky</a>
  <a href="contact.php" class="w3-bar-item w3-hide-small <?php if($page == 'contact.php'){ echo ' active"';}?>">Kontakt</a>
  <a href="#" class="w3-bar-item w3-hide-small w3-right">Prihlásenie</a>
  <a href="javascript:void(0)" class="w3-bar-item w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
</div> 

<div id="mobile" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium navbar">
  <a href="download.php" class="w3-bar-item">Na Stiahnutie</a>
  <a href="news.php" class="w3-bar-item">Novinky</a>
  <a href="contact.php" class="w3-bar-item">Kontakt</a>
  <a href="#" class="w3-bar-item">Prihlásenie</a>
</div>

<script>
  function myFunction() {
    var x = document.getElementById("mobile");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else { 
      x.className = x.className.replace(" w3-show", "");
    }
  }
    </script>