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

    protected function redirectIfNotLogged() 
    {
        if (!Auth::isLogged()) {
            exit("403 Access forbidden");
        }
    }

    protected function redirectIfNotAdmin()
    {
        if (!Auth::isAdmin()) {
            header("HTTP/1.1 403 Forbidden" );
            exit("403 Access forbidden");
        }
    }
}