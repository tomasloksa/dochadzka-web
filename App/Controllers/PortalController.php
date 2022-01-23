<?php

namespace App\Controllers;

use App\Models\Employee;
use App\Models\Action;
use App\Models\DayType;
use App\Models\AttendanceLog;
use App\Models\AttendanceDay;
use DateTime;

class PortalController extends AControllerRedirect
{
    public function index()
    {
        $this->redirectIfNotLogged();

        $id = $this->request()->getValue('id');
        $emp = Employee::getOne($id);
        if ($id && $_SESSION['role'] == 1 && $_SESSION['companyId'] == $emp->companyId) {
            $name = $emp->name." ".$emp->surname;
        } else {
            $id = $_SESSION['id'];
            $name = $_SESSION['name'];
        }
            
        $dayChanged = $this->request()->getValue('dayChanged') ?? -1;

        $month = $this->request()->getValue('month') ?? date('m');
        $year = $this->request()->getValue('year') ?? date('Y');

        if ($dayChanged == -1) {
            $attendanceLogs = AttendanceLog::getAll("employeeId = ? AND MONTH(time) = ? AND YEAR(time) = ? ORDER BY time ASC", [ $id, $month, $year ]);
            $attendanceDays = AttendanceDay::getAll("employeeId = ? AND month = ? AND year = ?", [ $id, $month, $year ]);
        } else {
            $attendanceLogs = AttendanceLog::getAll("employeeId = ? AND DAY(time) = ? AND MONTH(time) = ? AND YEAR(time) = ? ORDER BY time ASC", [ $id, $dayChanged + 1, $month, $year ]);
            $attendanceDays = AttendanceDay::getAll("employeeId = ? AND day = ? AND month = ? AND year = ?", [ $id, $dayChanged + 1, $month, $year ]);
        }

        $actionsByDay = $this->getActionsByDay($attendanceLogs);

        $dayTypes = new \SplFixedArray(31);
        foreach ($attendanceDays as &$day) {
            $dayTypes[$day->day - 1] = $day;
        }

        for ($i = 0; $i < 31; $i++) {
            if ($dayTypes[$i] == null) {
                $dayTypes[$i] = new AttendanceDay();

                if ($this->isWeekend($i + 1, $month, $year)) {
                    $dayTypes[$i]->dayType = 1;
                }
            }

            $dayTypes[$i]->totalTime = new DateTime();
            $dayTypes[$i]->totalTime->setTime(0, 0, 0);

            $start = null;
            foreach((array)$actionsByDay[$i] as $action) {
                if (($action->action == Action::Prichod->value 
                    || $action->action == Action::HomeOffice->value 
                    || $action->action == Action::SluzobnaCesta->value)) {
                    if (is_null($start)) {
                        $start = new DateTime($action->time);
                    } else {
                        $dayTypes[$i]->valid = false;
                    }
                } else if (!is_null($start)) {
                    $end = new DateTime($action->time);
                    $diff = $start->diff($end);
                    $dayTypes[$i]->totalTime->add($diff);
                    $start = null;
                } else {
                    $dayTypes[$i]->valid = false;
                }
            }
        }

        if ($dayChanged >= 0) {
            return $this->json($dayTypes[$dayChanged]);
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
        $this->redirectIfNotAdmin();

        $id = $this->request()->getValue('id');

        $employeeId = $this->request()->getValue('userId');
        $employee = Employee::getOne($employeeId);
        $this->redirectIfNotSameCompany($employee->companyId);
        
        if ($id > 0) {
          $attendanceDay = \App\Models\AttendanceDay::getOne($id);
        } else {
          $attendanceDay = new \App\Models\AttendanceDay();
          $attendanceDay->day = $this->request()->getValue('day');
          $attendanceDay->month = $this->request()->getValue('month');
          $attendanceDay->year = $this->request()->getValue('year');
          $attendanceDay->employeeId = $employeeId;
        }

        $attendanceDay->dayType = array_search($this->request()->getValue('dayType'), DayType::DAYTYPE);
        $attendanceDay->id = $attendanceDay->save();

        return $this->json($attendanceDay);
    }

    public function editAction() 
    {
        $this->redirectIfNotAdmin();

        $id = $this->request()->getValue('id');
        if(!empty($id)) {
            $action = \App\Models\AttendanceLog::getOne($id);

            $employee = Employee::getOne($action->employeeId);
            $this->redirectIfNotSameCompany($employee->companyId);

            if ($this->request()->getValue('action') == -1) {
              $action->delete();
              $day = date("j", strtotime($action->time)) - 1;
              return $this->redirect("portal", "index", ['id' => $action->employeeId, 'dayChanged' => $day]);
            }
        } else {
            $action = new \App\Models\AttendanceLog();

            $employeeId = $this->request()->getValue('userId');
            $action->employeeId = $employeeId;

            $employee = Employee::getOne($employeeId);
            $this->redirectIfNotSameCompany($employee->companyId);
        }
        $action->time = $this->request()->getValue('time');
        $action->action = $this->request()->getValue('action');
        $action->save();

        return $this->redirect("portal", "index", ['id' => $action->employeeId]);
    }

    public function input()
    {
        $this->redirectIfNotLogged();

        return $this->html();
    }

    public function addAction()
    {
        $this->redirectIfNotLogged();

        $action = new AttendanceLog;
        $action->employeeId = $_SESSION['id'];
        $action->time = date("Y-m-d H:i:s");
        $action->action = $this->request()->getValue('action');
        $action->save();

        $this->redirect('portal', 'index');
    }

    private function getActionsByDay($attendanceLogs) 
    {
        $actionsByDay = new \SplFixedArray(31);
        foreach ($attendanceLogs as &$log) {
            $day = date("j", strtotime($log->time)) - 1;
            $array = $actionsByDay[$day];
            if (is_null($array)) {
                $array = [];
            }
            array_push($array, $log);
            $actionsByDay[$day] = $array;
        }

        return $actionsByDay;
    }

    private function isWeekend($day, $month, $year)
    {
        $time = mktime(0, 0, 0, $month, $day, $year);
        $weekday = date('w', $time);

        return ($weekday == 0 || $weekday == 6);
    }
}