<?php

namespace core\database;


class Connection
{
    private static $instance;

    public static function getInstance(): \PDO
    {
        if (!self::$instance) {
            $host = $_ENV['DB_HOST'];
            $database = $_ENV['DB_DATABASE'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];
            self::$instance = new \PDO("mysql:host=$host;dbname=$database",$username,$password,[
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            ]);
        }

        return self::$instance;
        
    }
}
