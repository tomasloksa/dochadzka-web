<?php

namespace App\Config;

/**
 * Class Configuration
 * Main configuration for the application
 * @package App\Config
 */
class Configuration
{
    public const DB_HOST = 'db:3306';
    public const DB_NAME = 'poster';
    public const DB_USER = 'db_user';
    public const DB_PASS = 'db_user_pass';

    public const ROOT_LAYOUT = 'root.layout.view.php';

    public const DEBUG_QUERY = false;
}