<?php

namespace App\Controllers;

use App\Models\Employee;
use App\Models\Actions;
use App\Models\AttendanceLog;
use App\Auth;

class PortalController extends AControllerRedirect
{
    public function index()
    {
        $this->redirectHomeIfNotLogged();

        $id = $this->request()->getValue('id');
        if ($id) { //TODO and user is an administrator
            $emp = Employee::getOne($id);
            $name = $emp->name." ".$emp->surname;
        } else {
            $id = $_SESSION['id'];
            $name = $_SESSION['name'];
        }
            
        $attendanceLogs = AttendanceLog::getAll("employeeId = ?", [ $id ]);
        
        return $this->html([
            'logs' => $attendanceLogs,
            'name' => $name
        ]);
    }

    public function input()
    {
        $this->redirectHomeIfNotLogged();

        $actions = Actions::ACTIONS;
        return $this->html([
            'actions' => $actions
        ]);
    }

    public function addAction()
    {
        $this->redirectHomeIfNotLogged();

        $action = new AttendanceLog;
        $action->employeeId = $_SESSION['id'];
        $action->time = date("Y-m-d H:i:s");
        $inputAction = array_search($this->request()->getValue('action'), Actions::ACTIONS);

        if ($inputAction != false) {
            $action->action = $inputAction;
            $action->save();
        }

        $this->redirect('portal', 'index');
    }

    public function manage()
    {
        $this->redirectHomeIfNotLogged();

        $employees = Employee::getAll();

        return $this->html([
            'error' => $this->request()->getValue('error'),
            'employees' => $employees
        ]);
    }

    public function removeEmployee()
    {
        $this->redirectHomeIfNotLogged();

        //TODO only if is administrator of user's company

        $employeeId = $this->request()->getValue('id');
        if ($employeeId != $_SESSION['id']) {
            $employee = Employee::getOne($employeeId);
            $employee->delete();
            $this->redirect('portal', 'manage');
        } else {
            $this->redirect('portal', 'manage', ['error' => 'Nie je možné vymazať vedúceho zamestnanca!']);
        }
    }

    public function employeeEdit()
    {
        $this->redirectHomeIfNotLogged();

        //TODO only if is administrator of user's company

        $id = $this->request()->getValue('id');

        if ($id > 0) {
            $employee = Employee::getOne($id);
            return $this->html([
                'error' => $this->request()->getValue('error'),
                'employee' => $employee
            ]);
        }

        return $this->html();
    }

    public function saveEmployee()
    {
        $this->redirectHomeIfNotLogged();

        //TODO only if is administrator

        $id = $this->request()->getValue('id');
        $surname = $this->request()->getValue('surname');
        if ($id > 0) {
            $employee = Employee::getOne($id);
        } else {
            $employee = new Employee;
            $employee->companyId = 2;
            $employee->password = "heslo"; //TODO Tu by asi bolo fajn nastavit lowercase priezvisko bez diakritiky, alebo uplne zmenit registraciu
        }

        $employee->name = $this->request()->getValue('name');
        $employee->surname = $surname;
        $employee->mail = $this->request()->getValue('mail');
        $employee->save();

        if ($employee->id == $_SESSION['id']) {
            Auth::setName($employee);
        }

        $this->redirect('portal', 'manage');
    }

    public function settings()
    {
        $this->redirectHomeIfNotLogged();
        return $this->html([
            'error' => $this->request()->getValue('error'),
            'success' => $this->request()->getValue('success')
        ]);
    }

    public function changePassword() {
        $this->redirectHomeIfNotLogged();

        $user = Employee::getOne($_SESSION['id']);
        if ($user->password == $this->request()->getValue('oldPassword')) {
            if ($this->request()->getValue('newPassword') == $this->request()->getValue('newPasswordRepeat')) {
                $user->password = $this->request()->getValue('newPassword');
                $user->save();
                $this->redirect('portal', 'settings', ['success' => 'Heslo bolo úspešne zmenené.']);
            } 
            else {
                $this->redirect('portal', 'settings', ['error' => 'Heslá sa nezhodujú!']);
            }
        } 
        else {
            $this->redirect('portal', 'settings', ['error' => 'Nesprávne zadané pôvodné heslo!']);
        }
    }

    private function redirectHomeIfNotLogged() {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }
    }
}