<?php

namespace App\DB;

use PDO;
use PDOException;

class DB
{
    public static function connect(): PDO
    {
        try {
            // подключаемся к серверу
            $conn = new PDO("mysql:host=localhost;dbname=countrysides", "root", "", [
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

}
