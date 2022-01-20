<?php

namespace App\Models;

class Company extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public string $name = "",
    ) { }

    static public function setDbColumns(): array
    {
        return ['id', 'name'];
    }

    static public function setTableName(): string
    {
        return "company";
    }
}
