<?php

namespace App\Controllers;

use App\Models\Employee;
use App\Models\Actions;
use App\Models\DayType;
use App\Models\AttendanceLog;
use App\Models\AttendanceDay;

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
            
        $month = $this->request()->getValue('month') ?? date('m');
        $year = $this->request()->getValue('year') ?? date('Y');

        $attendanceLogs = AttendanceLog::getAll("employeeId = ? AND MONTH(time) = ? AND YEAR(time) = ? ORDER BY time ASC", [ $id, $month, $year ]);
        $attendanceDays = AttendanceDay::getAll("employeeId = ? AND month = ? AND year = ?", [ $id, $month, $year ]);

        $actionsByDay = new \SplFixedArray(32);
        foreach ($attendanceLogs as &$log) {
            $day = date("j", strtotime($log->time));
            $array = $actionsByDay[$day];
            if (is_null($array)) {
                $array = [];
            }
            array_push($array, $log);
            $actionsByDay[$day] = $array;
        }

        $dayTypes = new \SplFixedArray(32);
        foreach ($attendanceDays as &$day) {
            $dayTypes[$day->day] = $day;
        }
        
        return $this->html([
            'logs' => $actionsByDay,
            'name' => $name,
            'userId' => $id,
            'days' => $dayTypes,
            'dayTypes' => DayType::DAYTYPE,
            'month' => $month,
            'year' => $year
        ]);
    }

    public function setDayType() 
    {
        $this->redirectHomeIfNotAdmin();

        $search = \App\Models\AttendanceDay::getAll(
          "day = ? AND month = ? AND year = ?", 
          [ 
            $this->request()->getValue('day'),
            $this->request()->getValue('month'),
            $this->request()->getValue('year'),
          ]
        );
        if (empty($search)) {
          $attendanceDay = new \App\Models\AttendanceDay();
          $attendanceDay->day = $this->request()->getValue('day');
          $attendanceDay->month = $this->request()->getValue('month');
          $attendanceDay->year = $this->request()->getValue('year');
          $attendanceDay->employeeId = $this->request()->getValue('userId');
        } else {
          $attendanceDay = $search[0];
        }

        $attendanceDay->dayType = array_search($this->request()->getValue('dayType'), DayType::DAYTYPE);
        $attendanceDay->save();

        return $this->json($attendanceDay);
    }

    public function editAction() 
    {
        $this->redirectHomeIfNotAdmin();
        $id = $this->request()->getValue('id');

        if(!empty($id)) {
          $action = \App\Models\AttendanceLog::getOne($id);
          if ($this->request()->getValue('action') == -1)
            $action->delete();
            return $this->json("");
        } else {
          $action = new \App\Models\AttendanceLog();
          $action->employeeId = $this->request()->getValue('userId');
        }

        $action->time = $this->request()->getValue('time');
        $action->action = $this->request()->getValue('action');
        $action->save();

        return $this->json($action);
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
}