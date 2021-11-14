<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;

class PortalController extends AControllerBase
{
    public function input()
    {
        return $this->html();
    }

    public function manage()
    {
        return $this->html();
    }

    public function settings()
    {
        return $this->html();
    }

    public function index()
    {
        return $this->html();
    }
}