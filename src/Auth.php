<?php
namespace SafePHP;

use Error;
use PDO;
use SafePHP\CSRF;

require_once "./config/Database.php";

class Auth {
    public static function login($ASubmit, $name, $password){
        if (isset($ASubmit) && $ASubmit != null) {
            if (!CSRF::verifyCSRF()) {
                die("Jeton CSRF invalide !");
            } else {
                if($name === null || $password === null) {
                    die("Un ou plusieurs champs sont manquants !");
                }
                try {
                    $connexion = Database::connectDatabase();
                    $stmt = $connexion->prepare("SELECT (name, password) FROM users WHERE name = :name");
                    $stmt->bindValue(":name", $name, PDO::PARAM_STR);
                    $inscription = $stmt->execute();

                    $passwordverify = password_verify($password, PASSWORD_DEFAULT);

                    if ($passwordverify) {
                        $verificationUtilisateur = $connexion->prepare("SELECT * FROM users WHERE pseudo = :name");
                        $verificationUtilisateur->bindValue(":name", $name, PDO::PARAM_STR);
                        $verificationUtilisateur->execute([$name]);
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

    public static function register($name, $email, $password){
        if (isset($email, $name, $password) && !empty($name) && !empty($email) && !empty($password)) {
            $connexion = Database::connectDatabase();

            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $connexion->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password);");
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
            $stmt->bindValue(":password", $password_hash, PDO::PARAM_STR);

            $inscription = $stmt->execute([]);

            if ($inscription) {
                session_start();
                $idCompte = $connexion->lastInsertId();

                $_SESSION["Utilisateur"] = [
                    "ID" => $idCompte,
                    "Nom" => $name,
                    "Adresse_Mail" => $email,
                ];
                header("Location: ./index.php?action=accueilUtilisateur");
                exit();
            } else {
                echo "Erreur lors de l'inscription";
            }
        }
    }

    public static function logout()
    {
        session_unset();
        session_destroy();
    }
}