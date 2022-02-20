<?php

namespace App;

class DB
{
    private $connection;

    function __construct()
    {
        $this->connection = new \PDO('mysql:host=mysql;dbname=marlin;charset=utf8','root','3312', [\PDO::ERRMODE_EXCEPTION => true]);
    }

    public function select($sql, $params = [])
    {
        $query = $this->connection->prepare($sql, $params);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}