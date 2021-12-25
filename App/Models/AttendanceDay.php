<?php

namespace App\Models;

class AttendanceDay extends \App\Core\Model
{
    public function __construct(
        public DayType $dayType,
        public int $day = 0,
        public int $month = 0,
        public int $year = 0,
        public int $userId = 0
    ) { }

    static public function setDbColumns(): array
    {
        return ['day', 'month', 'year', 'userId', 'dayType'];
    }

    static public function setTableName(): string
    {
        return "attendanceDay";
    }
}
