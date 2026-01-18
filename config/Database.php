<?php
namespace SafePHP;
use PDO;
use PDOException;
use Dotenv\Dotenv;
//Utiliser le .env
class Database {
    public static function connectDatabase($host, $dbname, $name, $password, $port) {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8; port=$port", $name, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Error by login to database : " . $e->getMessage());
        }
    }
}