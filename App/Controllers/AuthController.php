<?php

namespace App\Controllers;

use App\Auth;

class AuthController extends AControllerRedirect
{
    public function index() { }

    public function loginForm()
    {
        return $this->html(
            [
                'error' => $this->request()->getValue('error')
            ]
        );
    }

    public function login()
    {
        $login = $this->request()->getValue('login');
        $password = $this->request()->getValue('password');

        $logged = Auth::login($login, $password);

        if ($logged) {
            $this->redirect('portal', 'input');
        } else {
            $this->redirect('auth', 'loginForm', ['error' => 'Nesprávne meno alebo heslo!']);
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('home');
    }
}