<?php

namespace App;

use App\Models\Employee;

class Auth
{
    public static function login($login, $password)
    {
        $users = Employee::getAll();

        foreach ($users as $user) {
            if ($login == $user->mail && $password == $user->password) {
                Auth::setName($user);
                $_SESSION['id'] = $user->id;
                return true;
            }
        }

        return false;
    }

    public static function setName($user) {
        $_SESSION['name'] = $user->name . " " . $user->surname;
    }

    public static function isLogged()
    {
        return isset($_SESSION['name']);
    }

    public static function logout()
    {
        unset($_SESSION['name']);
        unset($_SESSION['id']);
        session_destroy();
    }
}