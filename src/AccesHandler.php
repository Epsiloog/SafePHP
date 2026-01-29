<?php

namespace SafePHP;

use Exception;
use SafePHP\Auth;

class AccessHandler {
    public static function getPermissionsUtilisateur(){
        return $_SESSION['user_access_code'];
    }

    /**
     * Verify if the actual user can access a ressource by comparing his access's level
     * @param Session $sessionName name of the session (username)
     * @param int $codeAcces to have to pass
     * @throws Exception if false
     * @return void Return code 200
     */
    public static function verifyAccess(Session $session, $codeAcces){
       $userId =  Auth::verifAuth(/*$session->decryptSessionId*/($_SESSION["user_id"]));
        $codeAccesUser = $_SESSION["user_access_code"];
        if ($userId === false || $userId === null) {
            var_dump($userId);
            return new ErrorHandler(401, "401.php");
        }
        if ($codeAccesUser < $codeAcces) {
            return new ErrorHandler(403, "403.php");
        } else {
            http_response_code(200);
            http_response_code();
        }
    }
}