<?php
  $page = basename($_SERVER['PHP_SELF']);
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
    <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#exampleModal">Prihlásenie</button>
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
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>