<?php

namespace App\Models;

class Employee extends \App\Core\Model
{
    public function __construct(
        public int $day = 0,
        public int $month = 0,
        public int $year = 0,
        public int $userId = 0,
        public DayType $dayType
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
