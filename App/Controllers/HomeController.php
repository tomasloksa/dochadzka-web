<?php

namespace App\Controllers;

use App\Core\AControllerBase;

class HomeController extends AControllerBase
{

    public function index()
    {
        return $this->html();
    }

    public function contact()
    {
        return $this->html();
    }

    public function download()
    {
        return $this->html();
    }

    public function news()
    {
        return $this->html();
    }
}