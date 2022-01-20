<?php

namespace App\Controllers;

use App\Models\Employee;
use App\Models\Company;

class SettingsController extends AControllerRedirect
{
    public function index()
    {
      $this->redirectIfNotLogged();

      return $this->html([
          'error' => $this->request()->getValue('error'),
          'success' => $this->request()->getValue('success')
      ]);
    }

    public function changePassword() 
    {
        $this->redirectIfNotLogged();

        $user = Employee::getOne($_SESSION['id']);
        if (password_verify($this->request()->getValue('oldPassword'), $user->password)) {
            if ($this->request()->getValue('newPassword') == $this->request()->getValue('newPasswordRepeat')) {
                $password = $this->request()->getValue('newPassword');
                $salted_hash = password_hash($password, PASSWORD_DEFAULT);
                $user->password = $salted_hash;
                
                $user->save();
                $this->redirect('settings', 'index', ['success' => 'Heslo bolo úspešne zmenené.']);
            } 
            else {
                $this->redirect('settings', 'index', ['error' => 'Heslá sa nezhodujú!']);
            }
        } 
        else {
            $this->redirect('settings', 'index', ['error' => 'Nesprávne zadané pôvodné heslo!']);
        }
    }

    public function changeCompanyName() 
    {
        $this->redirectIfNotAdmin();

        $company = Company::getOne($_SESSION['companyId']);
        $company->name = $this->request()->getValue('companyName');
        $company->save();
        $_SESSION['companyName'] = $company->name;

        $this->redirect('settings', 'index', ['success' => 'Názov firmy bol úspešne zmenený.']);
    }
}