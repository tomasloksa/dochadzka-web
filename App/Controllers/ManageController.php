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
        if ($_SESSION['companyId'] == $employee->companyId) {
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

            if ($_SESSION['companyId'] == $employee->companyId) {
                return $this->html([
                    'error' => $this->request()->getValue('error'),
                    'employee' => $employee
                ]);
            }
        }

        return $this->html();
    }

    public function saveEmployee() 
    {
        $this->redirectIfNotAdmin();

        $id = $this->request()->getValue('id');

        if ($id > 0) {
            $employee = Employee::getOne($id);
        } else {
            $employee = new Employee;
            $employee->companyId = $_SESSION['companyId'];
            $employee->password = "heslo"; //TODO Tu by asi bolo fajn nastavit lowercase priezvisko bez diakritiky, alebo uplne zmenit registraciu
        }

        $employee->name = $this->request()->getValue('name');
        $employee->surname = $this->request()->getValue('surname');;
        $employee->mail = $this->request()->getValue('mail');
        $employee->save();

        if ($employee->id == $_SESSION['id']) {
            Auth::setSessionData($employee);
        }

        $this->redirect('manage');
    }
}