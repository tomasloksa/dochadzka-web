<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Dochádzkový systém</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="public/img/clock.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
<header>
    <div class="title">
        <h1 class="heading">Dochádzkový systém</h1>
    </div>

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mt-2 mt-lg-0">
                <?php $page = $_GET['a'] ?? ""; ?>
                <li class="nav-item <?php if(empty($page)){ echo ' active"';}?>">
                    <a href="?c=home" class="nav-link">Domov</a>
                </li>
                <li class="nav-item <?php if($page == 'download'){ echo ' active"';}?>">
                    <a href="?c=home&a=download" class="nav-link">Na Stiahnutie</a>
                </li>
                <li class="nav-item <?php if($page == 'news'){ echo ' active"';}?>">
                    <a href="?c=home&a=news" class="nav-link">Novinky</a>
                </li>
                <li class="nav-item <?php if($page == 'contact'){ echo ' active"';}?>">
                    <a href="?c=home&a=contact" class="nav-link">Kontakt</a>
                </li>
            </ul>
            <?php if (\App\Auth::isLogged()) { ?>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item <?php if($page == 'index'){ echo ' active"';}?>">
                        <a href="?c=portal&a=index" class="nav-link">Prehľad dochádzky</a>
                    </li>
                    <li class="nav-item <?php if($page == 'input'){ echo ' active"';}?>">
                        <a href="?c=portal&a=input" class="nav-link">Zadanie dochádzky</a>
                    </li>
                    <li class="nav-item <?php if($page == 'manage'){ echo ' active"';}?>">
                        <a href="?c=portal&a=manage" class="nav-link">Správa zamestnancov</a>
                    </li>
                    <li class="nav-item <?php if($page == 'settings'){ echo ' active"';}?>">
                        <a href="?c=portal&a=settings" class="nav-link">Nastavenia</a>
                    </li>
                    <li class="nav-item <?php if($page == 'logout'){ echo ' active"';}?>">
                        <a href="?c=auth&a=logout" class="nav-link">Odhlásenie</a>
                    </li>
                </ul>
            <?php } else { ?>
                <a class="btn btn-primary btn-lg" href="?c=auth&a=loginForm">Prihlásenie</a>
            <?php } ?>
        </div>
    </nav>
</header>

<div class="content">
    <?= $contentHTML ?>
</div>

<footer>
    <hr>
    <div class="footer">
        <h3>Kontakt</h3>
        <p>	Tomáš Lokša <br>
            tomas.loksa@outlook.com <br>
            +421 950 607 760
        </p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</footer>
</body>
</html>