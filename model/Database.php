<?php
namespace model;
use config\Config;

class Database
{
    private static ?\PDO $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): \PDO
    {
        if (self::$instance === null) {
            self::$instance = new \PDO(
                Config::get('DB_DSN'),
                Config::get('DB_USER'),
                Config::get('DB_PASSWORD')
            );
        }
        return self::$instance;
    }
}
?>