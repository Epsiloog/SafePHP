<?php
namespace SafePHP;

use PDO;

require_once "./config/Database.php";

class Auth
{
    public static function login($name, $password){
        $connexion = Database::connectDatabase("3306", "dbname", "name", "password", "port");
        $stmt = $connexion->prepare("SELECT (name, password) FROM users WHERE name = :name");
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->execute([]);

        $passwordverify = password_verify($password, PASSWORD_DEFAULT);

        if($passwordverify) {
            //Créer la session
        } else {
            echo "Identifiant ou mot de passe incorrect !";
            exit();
        }
    }

    public static function register($name, $email, $password){
        if (isset($email, $name, $password) && !empty($name) && !empty($email) && !empty($password)) {
            $connexion = Database::connectDatabase("3306", "dbname", "name", "password", "port");

            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $connexion->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password);");
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
            $stmt->bindValue(":password", $password_hash, PDO::PARAM_STR);

            $stmt->execute([]);

            //Créer une session
        }
    }

    public static function logout() {
        session_unset();
        session_destroy();
    }
}