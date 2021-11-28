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

    public function index()
    {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }

        if ($this->request()->getValue('id')) {
            $id = $this->request()->getValue('id');
            $name = Employee::getOne($id);
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
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }

        $actions = Actions::ACTIONS;
        return $this->html([
            'actions' => $actions
        ]);
    }

    public function addAction()
    {
        $action = new AttendanceLog;
        $action->employeeId = $_SESSION['id'];
        $action->time = date("Y-m-d H:i:s");
        $action->action = $this->request()->getValue('action');
        $action->save();

        $this->redirect('portal', 'index');
    }

    public function manage()
    {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }

        $employees = Employee::getAll();

        return $this->html([
            'employees' => $employees
        ]);
    }

    public function removeEmployee()
    {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }

        $employeeId = $this->request()->getValue('id');
        $employee = Employee::getOne($employeeId);
        $employee->delete();
        $this->redirect('portal', 'manage');
    }

    public function employeeEdit()
    {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }

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
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }

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
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }
        return $this->html();
    }
}