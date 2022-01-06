<?php

namespace App\Models;

class AttendanceDay extends \App\Core\Model
{
    public function __construct(
        public int $dayType = 0,
        public int $day = 0,
        public int $month = 0,
        public int $year = 0,
        public int $employeeId = 0
    ) { }

    static public function setDbColumns(): array
    {
        return ['day', 'month', 'year', 'employeeId', 'dayType'];
    }

    static public function setTableName(): string
    {
        return "attendanceDay";
    }
}
