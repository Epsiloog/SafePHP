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
    private static array $loginTry = [];
    
    /**
     * Login function with form's name, name and password inputs
     * @param string $submit Name of the form
     * @param string $name input of the name used to login
     * @param string $password password to authentify
     * @return bool state of connexion (true or false)
     */
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
                    $stmt->execute();

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


    /**
     * Register function with name, email and password inputs
     * @param string $name name of the user
     * @param string $email input of the email used to register
     * @param string $password password to authentify
     * @return void state of connexion (string error or header to the account page)
     */
    public static function register($name, $email, $password){
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


    /**
     * Destroy every sessions sets
     * @return void nothing...?
     */
    public static function logout(){
        session_unset();
        session_destroy();
    }

    /**
     * Verify the authentification by the user
     * @param string $sessionName the session to verify
     * @return void return error in case of false
     */
    public static function verifAuth($sessionName){
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["Utilisateur"]) || $_SESSION["Utilisateur"] !== $sessionName) {
            echo Exceptions::getErreurSession();
            throw new Exception("La session n'est pas valide !", 1);
        }
    }

    /**
     * Verify the authentification by the user
     * @param string $ipClient the IP Adresse that tried login
     * @return bool return true if cool if dosen't have cooldown 
     */
    public static function countLoginAttemps($ipClient){
        if (!self::hasIp($ipClient)) {
            self::$loginTry[$ipClient] = [
                "loginTry" => 0,
                "cooldown" => 0
            ];
        }

        if (self::$loginTry[$ipClient]["cooldown"] > time()) {
            echo Exceptions::getErreurCooldown();
            return false;
        }

        self::$loginTry[$ipClient]["loginTry"]++;

        if (self::$loginTry[$ipClient]["loginTry"] >= 5) {
            self::$loginTry[$ipClient]["cooldown"] = time() + (2 * 3600); // + 2 hours
            self::$loginTry[$ipClient]["loginTry"] = 0;
            Exceptions::getErreurCooldown();
            return false;
        }

        return true;
    }

    /**
     * @return array Retourne toutes les tentatives de connexion
     */
    public static function getHashMapTryLogin(): array {
        return self::$loginTry;
    }

    /**
     * @return void les informations de tentatives de connexion
     */
    public static function displayLoginAttempts(): void {
        foreach (self::$loginTry as $ip => $data) {
            echo "IP: {$ip} - Tentatives: {$data['loginTry']} - Cooldown: {$data['cooldown']}\n";
        }
    }

    /**
     * Verify the authentification by the user
     * @param string $clientIp the IP adresse to look for
     * @return bool return true if this IP adresse already tried connexion
     */
    public static function hasIp(string $clientIp): bool{
        return isset(self::$loginTry[$clientIp]);
    }


    /**
     * Verify the authentification by the user
     * @param string $ip client that try login
     * @param int $count number of try aviable before cooldown
     * @param string $cooldown timer of the cooldown until new try for this IP
     * @return void nothing....for the moment
     */
    public static function addIpTryLogin($ip, $count, $cooldown): void {
        self::$loginTry[$ip] = [
            "loginTry" => $count,
            "cooldown" => $cooldown
        ];

        return;
    }
}