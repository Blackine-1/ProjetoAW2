<?php

class DBConfig
{
    public static string $servername = "localhost";
    public static string $username = "root";
    public static string $password = "";
    public static string $database = "hexdracon";


    public static function getConn(): PDO
    {
        try {
            $conn = new \PDO("mysql:host=".self::$servername.";dbname=".self::$database, self::$username, self::$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Could not connect. " . $e->getMessage());
        }
        return $conn;
    }
}

