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
            $this->show403Error();
        }
    }

    protected function redirectIfNotAdmin()
    {
        if (!Auth::isAdmin()) {
            $this->show403Error();
        }
    }

    protected function redirectIfNotSameCompany($companyId)
    {
        if ($companyId != $_SESSION['companyId']) {
            $this->show403Error();
        }
    }

    private function show403Error() {
        header("HTTP/1.1 403 Forbidden" );
        exit("403 Access forbidden");
    }
}