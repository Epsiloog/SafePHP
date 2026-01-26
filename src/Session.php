<?php

namespace SafePHP;
use SessionHandler;
use Dotenv\Dotenv;


#===DO NOT USE IT YET ! IT'S NOT FINISHED !!! (That's why there is no doc in the readme about this class)===#
class Session extends SessionHandler{
    private bool $RegenerateCookies = true;
    private string $encrytMethod = "AES-256-CBC";
    private string $secretKey = "";

    private string $iv = "XDFGTESHGJYLYFH";

    public function __construct($ARegenCookie){
        if ($ARegenCookie === true) {
            $RegenerateCookies = true;
            session_regenerate_id(true);
        } else {
            $RegenerateCookies = false;
            session_regenerate_id(false);
        }

        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        self::$secretKey = $_ENV["SESSION_SECRET_KEY"];
        return;
    }

    public static function disableSession($ASessionName){
        unset($ASessionName);
    }

    public static function regenSession($ASessionId){
        session_regenerate_id($ASessionId);
    }

    public function encryptSessionId($id) {
        $encryptedKey = hash('sha256', self::$secretKey);
        $iv = substr(hash('sha256', self::$iv), 0, 16);
        $encryptedSessionId = openssl_encrypt($id, self::$encrytMethod, $encryptedKey, 0, $iv);
        $encryptedSessionId = base64_encode($encryptedSessionId);
        return $encryptedKey;
    }

    public function decryptSessionId($userId) {
        $userId = base64_encode($userId);
        $encodedKey = hash("sha256", self::$secretKey);
        $iv = substr(hash("sha256", self::$iv), 0, 16);
        $id = openssl_decrypt($userId, self::$encrytMethod, $encodedKey, 0, $iv);
        return $id;
    }
}