<?php

namespace App\Controllers;

use App\Auth;

abstract class AControllerRedirect extends \App\Core\AControllerBase
{
    protected function redirect($controller, $action = "", $params = [])
    {
        $location = "Location: ?c=$controller";
        if ($action != "") {
            $location .= "&a=$action";
        }
        foreach ($params as $name => $value) {
            $location .= "&$name=" . urlencode($value);
        }
        header($location);
    }

    protected function redirectHomeIfNotLogged() 
    {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }
    }

    protected function redirectHomeIfNotAdmin()
    {
        if ($_SESSION['role'] < 1) {
          header("HTTP/1.1 403 Forbidden" );
          $this->redirect("portal");
        }
    }
}