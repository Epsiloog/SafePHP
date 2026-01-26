<?php
namespace SafePHP;

use Error;
use Exception;
use PDO;
use SafePHP\CSRF;
use SafePHP\Network;
use SafePHP\Exceptions;

require_once "./src/Database.php";

class Auth {
    private static int $loginAttemps = 0;
    private static array $loginTry = [
        "clientIp" => "",
        array(
            "loginTry" => "",
            "cooldown" => ""
        ),
    ];

    public static function login($submit, $name, $password){
        if (isset($submit) && $submit != null) {
            if (!CSRF::verifyCSRF()) {
                die("Jeton CSRF invalide !");
            } else {
                if ($name === null || $password === null) {
                    die("Un ou plusieurs champs sont manquants !");
                }
                $filterName = Sanitize::sanitize($name, "text");
                $filterPassword = Sanitize::sanitize($password, "text");
                $ipClient = Network::getClientIP();
                try {
                    $connexion = Database::connectDatabase();
                    $stmt = $connexion->prepare("SELECT (name, password) FROM users WHERE name = :name");
                    $stmt->bindValue(":name", $filterName, PDO::PARAM_STR);
                    $inscription = $stmt->execute();

                    $passwordverify = password_verify($filterPassword, PASSWORD_DEFAULT);

                    if ($passwordverify) {
                        $verificationUtilisateur = $connexion->prepare("SELECT * FROM users WHERE pseudo = :name");
                        $verificationUtilisateur->bindValue(":name", $filterName, PDO::PARAM_STR);
                        $verificationUtilisateur->execute([$filterName]);
                        $unUtilisateur = $verificationUtilisateur->fetch(PDO::FETCH_ASSOC);

                        if ($unUtilisateur) {
                            if (password_verify($password, $unUtilisateur['mot_de_passe'])) {
                                session_start();
                                $_SESSION["Utilisateur"] = [
                                    "ID" => $unUtilisateur['id'],
                                    "Nom" => $unUtilisateur['name'],
                                    "Adresse_Mail" => $unUtilisateur['email'],
                                ];
                                header("Location: ./index.php?action=accueilUtilisateur");
                                exit();
                            } else {
                                echo "Pseudo ou mot de passe incorrect";
                                return self::countLoginAttemps($ipClient);
                            }
                        }
                    }
                } catch (Error $e) {
                    echo $e->getMessage();
                    die();
                }
            }
        }
    }

    public static function register($name, $email, $password)
    {
        if (isset($email, $name, $password) && !empty($name) && !empty($email) && !empty($password)) {

            $filterName = Sanitize::sanitize($name, "text");
            $filterEmail = Sanitize::sanitize($email, "email");
            $filterPassword = Sanitize::sanitize($password, "text");
            $connexion = Database::connectDatabase();

            $password_hash = password_hash($filterPassword, PASSWORD_DEFAULT);
            $stmt = $connexion->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password);");
            $stmt->bindValue(":name", $filterName, PDO::PARAM_STR);
            $stmt->bindValue(":email", $filterEmail, PDO::PARAM_STR);
            $stmt->bindValue(":password", $password_hash, PDO::PARAM_STR);

            $inscription = $stmt->execute([]);

            if ($inscription) {
                session_start();
                $idCompte = $connexion->lastInsertId();

                $_SESSION["Utilisateur"] = [
                    "ID" => $idCompte,
                    "Nom" => $filterName,
                    "Adresse_Mail" => $filterEmail,
                ];
                header("Location: ./index.php?action=accueilUtilisateur");
                exit();
            } else {
                echo "Erreur lors de l'inscription";
            }
        }
    }

    public static function logout(){ 
        session_unset();
        session_destroy();
    }

    public static function verifAuth($sessionName){
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION[$sessionName])) {
            echo Exceptions::getErreurSession();
            throw new Exception("La session n'est pas valide !", 1);
        }
    }

    public static function countLoginAttemps($ipClient) {
        if(self::$loginTry["cooldown"] === 0) {
            if(self::$loginAttemps === 5) {
                date_default_timezone_set("Europe/Lisbon");
                $actualTime = strtotime(time());
                $minusTime = strtotime("-2 hour");
                self::$loginTry["cooldown"] = $actualTime - $minusTime;
                return self::$loginTry["loginTry"] = 0;
            } else {
                    return self::$loginTry["loginTry"]++;
            }
        } else {
            echo Exceptions::getErreurCooldown();
        }
    }

    /**
    * Fonctions de gestion du hashmap
    */
    public static function getHashMapTryLogin(){
        return self::$loginTry;
    }

    public static function hasIp(string $clientIp): bool {
        return isset(self::$loginTry[$clientIp]);
    }

    public static function addIpTryLogin($ip, $count, $cooldown){
        return array_push(self::$loginTry, $ip, $count, $cooldown)  ;
    }
}