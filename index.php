<?php
session_start();

require "ClassLoader.php";
require('FirePHPCore/fb.php');

use App\App;

date_default_timezone_set('Europe/Bratislava');

$app = new App();
$app->run();