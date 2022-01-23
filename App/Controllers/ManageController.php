<?php

namespace App\Controllers;

use App\Models\Employee;
use App\Auth;

class ManageController extends AControllerRedirect
{
    public function index()
    {
        $this->redirectIfNotAdmin();

        $employees = Employee::getAll("companyId = ?", [ $_SESSION['companyId'] ]);

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
        $this->redirectIfNotSameCompany($employee->companyId);
        fb($employee);

        if ($employee->role == 0) {
            fb("deleting");
            $employee->delete();
            $this->redirect('manage');
        } else {
            $this->redirect('manage', 'index', ['error' => 'Nie je možné vymazať vedúceho zamestnanca!']);
        }
    }

    public function employeeEdit()
    {
        $this->redirectIfNotAdmin();

        $id = $this->request()->getValue('id');
        if (isset($id) && $id > 0) {
            $employee = Employee::getOne($id);
            $this->redirectIfNotSameCompany($employee->companyId);

            if ($_SESSION['companyId'] == $employee->companyId) {
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
            $this->redirectIfNotSameCompany($employee->companyId);
        } else {
            $employee = new Employee;
            $employee->companyId = $_SESSION['companyId'];
            $employee->password = password_hash($this->request()->getValue('surname'), PASSWORD_DEFAULT);
        }

        $mail = $this->request()->getValue('mail');
        if ($mail != $employee->mail) {
            $usersWithEmail = Employee::getAll('mail = ?', [$mail]);
        }
        if (!empty($usersWithEmail)) {
            $this->redirect('manage', "employeeEdit", ['id' => $id, 'error' => 'Používateľ so zadaným emailom už existuje!']);
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