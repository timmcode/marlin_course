<?php

namespace App;

class DB
{
    private static $connection;

    public function __construct()
    {
        self::$connection = new \PDO('mysql:host=mysql;dbname=marlin_course_app;charset=utf8','root','3312', [\PDO::ERRMODE_EXCEPTION => true]);
    }

    private static function getConnection()
    {
        return self::$connection ?? (self::$connection = new self);
    }

    public function select($sql, $params = [])
    {
        $query = self::getConnection()->prepare($sql);
        $query->execute($params);

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert($sql, $params = [])
    {
        $query = self::getConnection()->prepare($sql);
        $query->execute($params);
    }
}