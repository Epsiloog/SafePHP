<?php
namespace SafePHP;
use PDO;
use PDOException;
use Dotenv\Dotenv;
//Utiliser le .env
class Database {
    public static function connectDatabase() {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $host = $_ENV["HOST"];
        $port = $_ENV["PORT"];
        $dbname = $_ENV["DB_NAME"];
        $user_name = $_ENV["USER_NAME"];
        $password = $_ENV["PASSWORD_DB"];
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8; port=$port", $user_name, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Error by login to database : " . $e->getMessage());
        }
    }
}