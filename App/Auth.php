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
                $_SESSION['name'] = $user->name . " " . $user->surname;
                $_SESSION['id'] = $user->id;
                return true;
            }
        }

        return false;
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