<?php
namespace SafePHP;

class CSRF {
    public function createCSRF(){
         if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $CSRF_TOKEN = bin2hex(random_bytes(32));
        echo "<input type='hidden' name='csrf_token' value=" .  $CSRF_TOKEN . " '>";
        $_SESSION['csrf_token'] = $CSRF_TOKEN;
        return sprintf("<input type='hidden' name='csrf_token' value='%s'", htmlspecialchars($CSRF_TOKEN, ENT_QUOTES, ));
    }

    public function verifyCSRF($CSRF_INPUT){
        if(!isset($CSRF_INPUT) || $CSRF_INPUT == null || $CSRF_INPUT !== $_SESSION["csrf_token"]){
            die("Invalid CSRF Token !");
        }
    }
}