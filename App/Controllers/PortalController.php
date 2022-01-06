<?php

namespace App\Controllers;

use App\Models\Employee;
use App\Models\Actions;
use App\Models\DayType;
use App\Models\AttendanceLog;
use App\Models\AttendanceDay;
use App\Auth;

class PortalController extends AControllerRedirect
{
    public function index()
    {
        $this->redirectHomeIfNotLogged();

        $id = $this->request()->getValue('id');
        $emp = Employee::getOne($id);
        if ($id && $_SESSION['role'] == 1 && $_SESSION['companyId'] == $emp->companyId) {
            $name = $emp->name." ".$emp->surname;
        } else {
            $id = $_SESSION['id'];
            $name = $_SESSION['name'];
        }
            
        $attendanceLogs = AttendanceLog::getAll("employeeId = ?", [ $id ]);
        $attendanceDays = AttendanceDay::getAll();

        $actionsByDay = new \SplFixedArray(31);
        foreach ($attendanceLogs as &$log) {
            $day = date("d", strtotime($log->time));
            $array = $actionsByDay[$day];
            if (is_null($array)) {
                $array = [];
            }
            array_push($array, $log);
            $actionsByDay[$day] = $array;
        }
        
        return $this->html([
            'logs' => $actionsByDay,
            'name' => $name,
            'days' => $attendanceDays,
            'dayTypes' => DayType::DAYTYPE
        ]);
    }

    public function setDayType() {
        $this->redirectHomeIfNotAdmin();

        $search = \App\Models\AttendanceDay::getAll(
          "day = ? AND month = ? AND year = ?", 
          /*[ 
            $this->request()->getValue('day'),
            $this->request()->getValue('month'),
            $this->request()->getValue('year'),
          ]*/
          [ 
            5,1,2022
          ]
        );
        if (empty($search)) {
          $attendanceDay = new \App\Models\AttendanceDay(1);
          $attendanceDay->day = 5;
          $attendanceDay->month = 1;
          $attendanceDay->year = 2022;
          $attendanceDay->employeeId = 2;
        } else {
          $attendanceDay = $search[0];
        }

        $attendanceDay->save();
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
        $this->redirectHomeIfNotAdmin();

        $employees = Employee::getAll();

        return $this->html([
            'error' => $this->request()->getValue('error'),
            'employees' => $employees
        ]);
    }

    public function removeEmployee()
    {
        $this->redirectHomeIfNotLogged();
        $this->redirectHomeIfNotAdmin();

        $employeeId = $this->request()->getValue('id');
        $employee = Employee::getOne($employeeId);
        if ($_SESSION['companyId'] == $employee->companyId) {
            $employee->delete();
            $this->redirect('portal', 'manage');
        } else {
            $this->redirect('portal', 'manage', ['error' => 'Nie je možné vymazať vedúceho zamestnanca!']);
        }
    }

    public function employeeEdit()
    {
        $this->redirectHomeIfNotLogged();
        $this->redirectHomeIfNotAdmin();

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
        $this->redirectHomeIfNotLogged();
        $this->redirectHomeIfNotAdmin();

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
            Auth::setSessionData($employee);
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

    public function changePassword() 
    {
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

    private function redirectHomeIfNotLogged() 
    {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }
    }

    private function redirectHomeIfNotAdmin()
    {
        if ($_SESSION['role'] < 1) {
            $this->redirect("home");
        }
    }
}