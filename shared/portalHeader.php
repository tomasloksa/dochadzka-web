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
        <a href="index.php" class="nav-link">Zadanie dochádzky</a>
      </li>
      <li class="nav-item <?php if($page == 'download.php'){ echo ' active"';}?>">
        <a href="download.php" class="nav-link">Prehľad dochádzky</a>
      </li>
      <li class="nav-item <?php if($page == 'news.php'){ echo ' active"';}?>">
        <a href="news.php" class="nav-link">Správa zamestnancov</a>
      </li>
      <li class="nav-item <?php if($page == 'contact.php'){ echo ' active"';}?>">
        <a href="contact.php" class="nav-link">Nastavenia</a>
      </li>
    </ul>
  </p>
  <a href="logout.php" class="btn btn-danger ml-3">Odhlásiť sa</a>
  </div>
</nav>