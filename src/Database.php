<?php
namespace SafePHP;
use PDO;
use PDOException;
use Dotenv\Dotenv;
class Database {

    /**
     * Connexion to the database with secrets keys aviables on .env file
     * @return PDO object to manipulate SQL
     */
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

    /**
     * Create SQL request prepared to avoid injection, don't forget to add verify &/or sanitize functions for more safety
     * @param string $Query request to forge
     * @return void
     */
    public static function InsertSQL(string $Query){
        $connexion = self::connectDatabase();
        $connexion->prepare($Query);
    }
}