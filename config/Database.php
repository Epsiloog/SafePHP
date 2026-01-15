<?php
namespace SafePHP;
use PDO;
use PDOStatement;
use PDOException;

class Database {
    public static function connectDatabase($host, $dbname, $name, $password, $port) {
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8; port=$port", $name, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Error by login to database : " . $e->getMessage());
        }
    }
}