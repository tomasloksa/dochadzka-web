<?php

namespace App\Models;

class User extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public ?string $username = null,
        public ?string $password = null
    ) { }

    static public function setDbColumns(): array
    {
        return ['id', 'username', 'password'];
    }

    static public function setTableName(): string
    {
        return "user";
    }
}
