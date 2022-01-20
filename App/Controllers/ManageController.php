<?php

namespace App\Controllers;

use App\Models\Employee;
use App\Auth;

class ManageController extends AControllerRedirect
{
    public function index()
    {
        $this->redirectIfNotAdmin();

        $employees = Employee::getAll();

        return $this->html([
            'error' => $this->request()->getValue('error'),
            'employees' => $employees
        ]);
    }

    public function removeEmployee()
    {
        $this->redirectIfNotAdmin();

        $employeeId = $this->request()->getValue('id');
        $employee = Employee::getOne($employeeId);
        if ($_SESSION['company']->id == $employee->companyId) {
            $employee->delete();
            $this->redirect('manage');
        } else {
            $this->redirect('manage', ['error' => 'Nie je možné vymazať vedúceho zamestnanca!']);
        }
    }

    public function employeeEdit()
    {
        $this->redirectIfNotAdmin();

        $id = $this->request()->getValue('id');
        if (isset($id)) {
            $employee = Employee::getOne($id);

            if ($_SESSION['company']->id == $employee->companyId) {
                return $this->html([
                    'error' => $this->request()->getValue('error'),
                    'employee' => $employee
                ]);
            }
        }

        return $this->html([
            'error' => $this->request()->getValue('error'),
        ]);
    }

    public function saveEmployee() 
    {
        $this->redirectIfNotAdmin();

        $id = $this->request()->getValue('id');

        if ($id > 0) {
            $employee = Employee::getOne($id);
        } else {
            $employee = new Employee;
            $employee->companyId = $_SESSION['company']->id;
            $employee->password = password_hash($this->request()->getValue('surname'), PASSWORD_DEFAULT);
        }

        $mail = $this->request()->getValue('mail');
        $usersWithEmail = Employee::getAll('mail = ?', [$mail]);
        if (!empty($usersWithEmail)) {
            $this->redirect('manage', "employeeEdit", ['error' => 'Používateľ so zadaným emailom už existuje!']);
        } else {
            $employee->name = $this->request()->getValue('name');
            $employee->surname = $this->request()->getValue('surname');
            $employee->mail = $this->request()->getValue('mail');
            $employee->save();
    
            if ($employee->id == $_SESSION['id']) {
                Auth::setSessionData($employee);
            }
    
            $this->redirect('manage');
        }
    }
}