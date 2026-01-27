<?php

namespace SafePHP;
use SessionHandler;
use Dotenv\Dotenv;


#===DO NOT USE IT YET ! IT'S NOT FINISHED !!! (That's why there is no doc in the readme about this class)===#
class Session extends SessionHandler{
    private bool $RegenerateCookies = true;
    private string $encrytMethod = "AES-256-CBC";
    private string $secretKey = "";
    private string $iv = "";

    /**
     * Construct the Session object with env key a secrets key
     * @param bool $ARegenCookie set if the constructor must regenerate the session's id or not
     * @return void
     */
    public function __construct($ARegenCookie){
        if ($ARegenCookie === true) {
            self::$RegenerateCookies = true;
            session_regenerate_id(true);
        } else {
            self::$RegenerateCookies = false;
            session_regenerate_id(false);
        }

        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        self::$secretKey = $_ENV["SESSION_SECRET_KEY"];
        self::$secretKey = $_ENV["SESSION_IV"];
        return;
    }

    /**
     * Disable a session
     * @param string $ASessionName the session to disable
     * @return void Nothing...?
     */
    public static function disableSession($ASessionName){
        unset($ASessionName);
    }

    /**
     * @param int $ASessionId the identifiant of session
     * @return bool return true if it succes, else false
     */
    public static function regenSession($ASessionId){
        return session_regenerate_id($ASessionId);
    }


    /** Encrypt the session's id on sha256
     * @param int $id
     * @return string Return the key encreypted
     */
    public function encryptSessionId($id) {
        $encryptedKey = hash('sha256', self::$secretKey);
        $iv = substr(hash('sha256', self::$iv), 0, 16);
        $encryptedSessionId = openssl_encrypt($id, self::$encrytMethod, $encryptedKey, 0, $iv);
        $encryptedSessionId = base64_encode($encryptedSessionId);
        return $encryptedKey;
    }

    /** Dencrypt the session's id
     * @param int $id user iditifiant (get it in session)
     * @return string Return the key decreypted
     */
    public function decryptSessionId($userId) {
        $userId = base64_encode($userId);
        $encodedKey = hash("sha256", self::$secretKey);
        $iv = substr(hash("sha256", self::$iv), 0, 16);
        $id = openssl_decrypt($userId, self::$encrytMethod, $encodedKey, 0, $iv);
        return $id;
    }
}