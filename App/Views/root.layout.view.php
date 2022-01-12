<!DOCTYPE html>
<html lang="sk" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Dochádzkový systém</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="public/img/clock.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/d5898694ab.js" crossorigin="anonymous"></script>
    <script src="public/script.js"></script>
</head>

<body>
<header>
    <div class="title">
        <h1 class="heading">Dochádzkový systém</h1>
        <div class="user-name">
            <?php if (isset($_SESSION['name'])) { ?>
                <p class="logged-user"><i class="fas fa-user"></i> <?php echo $_SESSION['name'] ?></p>
            <?php } ?>
        </div>
    </div>

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mt-2 mt-lg-0">
                <?php 
                    $page = $_GET['a'] ?? "";
                    $c = $_GET['c'] ?? "";
                ?>
                <li class="nav-item <?php if(empty($page)){ echo 'active';}?>">
                    <a href="?c=home" class="nav-link">Domov</a>
                </li>
                <li class="nav-item <?php if($page == 'download'){ echo 'active';}?>">
                    <a href="?c=home&a=download" class="nav-link">Na Stiahnutie</a>
                </li>
                <li class="nav-item <?php if($page == 'news'){ echo 'active';}?>">
                    <a href="?c=home&a=news" class="nav-link">Novinky</a>
                </li>
                <li class="nav-item <?php if($page == 'contact'){ echo 'active';}?>">
                    <a href="?c=home&a=contact" class="nav-link">Kontakt</a>
                </li>
            </ul>
            <?php if (\App\Auth::isLogged()) { ?>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item <?php if($c == 'portal' && $page == 'index'){ echo 'active';}?>">
                        <a href="?c=portal&a=index" class="nav-link">Prehľad dochádzky</a>
                    </li>
                    <li class="nav-item <?php if($page == 'input'){ echo 'active';}?>">
                        <a href="?c=portal&a=input" class="nav-link">Vloženie dochádzky</a>
                    </li>
                    <?php if ($_SESSION['role'] == 1) { ?>
                        <li class="nav-item <?php if($c == 'manage'){ echo 'active';}?>">
                            <a href="?c=manage&a=index" class="nav-link">Správa zamestnancov</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item <?php if($page == 'settings'){ echo 'active';}?>">
                        <a href="?c=portal&a=settings" class="nav-link">Nastavenia</a>
                    </li>
                    <li class="nav-item <?php if($page == 'logout'){ echo 'active';}?>">
                        <a href="?c=auth&a=logout" class="nav-link">Odhlásenie</a>
                    </li>
                </ul>
            <?php } else { ?>
                <a class="btn btn-primary btn-lg" href="?c=auth&a=loginForm">Prihlásenie</a>
            <?php } ?>
        </div>
    </nav>
</header>

<div class="content<?php if($c != 'portal' || $page != 'index') { echo ' margins';}?>">
    <?= $contentHTML ?>
</div>

<?php if($c != 'home' || $page != 'contact') {?>
<footer >
    <hr>
    <div class="footer">
        <h3>Kontakt</h3>
        <p>	Tomáš Lokša <br>
            tomas.loksa@outlook.com <br>
            +421 950 607 760
        </p>
    </div>
</footer>
<?php } ?>
</body>
</html>