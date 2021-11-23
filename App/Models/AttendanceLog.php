<?php

namespace App\Models;

class AttendanceLog extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public int $employeeId = 0,
        public ?string $time = null,
        public ?string $action = null,
    ) { }

    static public function setDbColumns(): array
    {
        return ['id', 'employeeId', 'time', 'action'];
    }

    static public function setTableName(): string
    {
        return "attendance";
    }
}
