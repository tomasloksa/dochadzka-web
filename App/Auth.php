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
                Auth::setSessionData($user);
                return true;
            }
        }

        return false;
    }

    public static function setSessionData($user) {
        $_SESSION['name'] = $user->name . " " . $user->surname;
        $_SESSION['id'] = $user->id;
        $_SESSION['role'] = $user->role;
        $_SESSION['companyId'] = $user->companyId;
    }

    public static function isLogged()
    {
        return isset($_SESSION['name']);
    }

    public static function logout()
    {
        unset($_SESSION['name']);
        unset($_SESSION['id']);
        unset($_SESSION['role']);
        unset($_SESSION['companyId']);
        session_destroy();
    }
}