<?php

namespace Core;

use Medoo\Medoo;

class Database
{
    public static $instance;
    private $connection;

    public function __construct(
        string $host,
        string $username,
        string $password,
        string $dbname
    )
    {
        $this->connection = new Medoo([
            'database_type' => 'mysql',
            'database_name' => $dbname,
            'server' => $host,
            'username' => $username,
            'password' => $password
        ]);
        self::$instance = $this;
    }

    public function connection():Medoo
    {
        return $this->connection;
    }
}