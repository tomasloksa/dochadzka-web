<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Employee;
use App\Models\Actions;
use App\Models\AttendanceLog;
use App\Auth;

class PortalController extends AControllerRedirect
{
    private function redirectHomeIfNotLogged() {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }
    }

    public function index()
    {
        $this->redirectHomeIfNotLogged();

        if ($this->request()->getValue('id')) {
            $id = $this->request()->getValue('id');
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
        $action->action = $this->request()->getValue('action');
        $action->save();

        $this->redirect('portal', 'index');
    }

    public function manage()
    {
        $this->redirectHomeIfNotLogged();

        $employees = Employee::getAll();

        return $this->html([
            'employees' => $employees
        ]);
    }

    public function removeEmployee()
    {
        $this->redirectHomeIfNotLogged();

        $employeeId = $this->request()->getValue('id');
        $employee = Employee::getOne($employeeId);
        $employee->delete();
        $this->redirect('portal', 'manage');
    }

    public function employeeEdit()
    {
        $this->redirectHomeIfNotLogged();

        $id = $this->request()->getValue('id');

        if ($id > 0) {
            $employee = Employee::getOne($id);
            return $this->html([
                'employee' => $employee
            ]);
        }

        return $this->html();
    }

    public function saveEmployee()
    {
        $this->redirectHomeIfNotLogged();

        $employee = new Employee;

        $id = $this->request()->getValue('id');
        if (isset($id)) {
            $employee->id = $id;
        }
        $employee->companyId = 2;
        $employee->name = $this->request()->getValue('name');
        $employee->surname = $this->request()->getValue('surname');
        $employee->mail = $this->request()->getValue('mail');
        $employee->save();

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
            } 
            else {
                $this->redirect('portal', 'settings', ['error' => 'Heslá sa nezhodujú!']);
            }
        } 
        else {
            $this->redirect('portal', 'settings', ['error' => 'Nesprávne zadané pôvodné heslo!']);
        }

        $user->save();
        $this->redirect('portal', 'settings', ['success' => 'Heslo bolo úspešne zmenené.']);
    }
}