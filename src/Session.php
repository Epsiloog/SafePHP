<?php

namespace SafePHP;
use SessionHandler;

#===DO NOT USE IT YET ! IT'S NOT FINISHED !!! (That's why there is no doc in the readme about this class)===#
class Session extends SessionHandler{
    private bool $RegenerateCookies = true;
    private string $encrytMethod = "AES-256-CBC";
    private string $secretKey = "f487f3f3e6d1ebd19e1073d96a09df775b3c71deebd94fdc055db3a9cc29e5ad";

    private string $iv = "XDFGTESHGJYLYFH";

    public function __construct($ARegenCookie)
    {
        if ($ARegenCookie === true) {
            $RegenerateCookies = true;
            return session_regenerate_id(true);
        } else {
            $RegenerateCookies = false;
            return session_regenerate_id(false);
        }
    }

    public static function disableSession($ASessionName){
        unset($ASessionName);
    }

    public static function regenSession($ASessionId){
        session_regenerate_id($ASessionId);
    }

    public static function encryptSessionId($id) {
        $encryptedKey = hash('sha256', self::$secretKey);
        $iv = substr(hash('sha256', self::$iv), 0, 16);
        $encryptedSessionId = openssl_encrypt($id, self::$encrytMethod, $encryptedKey, 0, $iv);
        $encryptedSessionId = base64_encode($encryptedSessionId);
        return $encryptedKey;
    }

    public static function decryptSessionId($userId) {
        $userId = base64_encode($userId);
        $encodedKey = hash("sha256", self::$secretKey);
        $iv = substr(hash("sha256", self::$iv), 0, 16);
        $id = openssl_decrypt($userId, self::$encrytMethod, $encodedKey, 0, $iv);
        return $id;
    }
}