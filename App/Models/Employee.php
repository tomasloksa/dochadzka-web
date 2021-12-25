<?php

namespace App\Models;

class Employee extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public int $companyId = 0,
        public ?string $name = null,
        public ?string $surname = null,
        public ?string $mail = null,
        public ?string $password = null,
        public int $role = 0
    ) { }

    static public function setDbColumns(): array
    {
        return ['id', 'companyId', 'name', 'surname', 'mail', 'password', 'role'];
    }

    static public function setTableName(): string
    {
        return "employee";
    }
}
