<?php

namespace App\Models;

use DateTime;

class AttendanceDay extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public int $dayType = 0,
        public int $day = 0,
        public int $month = 0,
        public int $year = 0,
        public int $employeeId = 0,
        public ?DateTime $totalTime = null,
        public ?bool $valid = true
    ) { }

    static public function setDbColumns(): array
    {
        return ['id', 'day', 'month', 'year', 'employeeId', 'dayType'];
    }

    static public function setTableName(): string
    {
        return "attendanceDay";
    }
}
