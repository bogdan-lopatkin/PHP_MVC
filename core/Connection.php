<?php

namespace Core;

use PDO;

class Connection
{
    private static $instance = null;

    public function __construct()
    {
        if (!self::$instance) {
            self::$instance = new PDO(
                config('databases.mysql.connection'),
                config('databases.mysql.user'),
                config('databases.mysql.password')
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->exec('SET NAMES ' . config('databases.mysql.encoding'));
            self::$instance->exec("SET time_zone = '".  config('databases.mysql.timezone') . "'");
        }
    }

    public static function getPdo(): PDO
    {
        return self::$instance;
    }


}