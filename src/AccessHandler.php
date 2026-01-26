<?php

namespace SafePHP;

use Exception;

class AccessHandler {
    private static array $permissions = [
        "id" => null,
        "titlePermission" => null,
        "codePermission" => null
    ];
    
    private string $accessHandlerDir = __DIR__ . "/AccessHandler/";

    public function __construct($errorCode, $fileErrorInclusion){
        echo http_response_code($errorCode);
        require_once self::$accessHandlerDir . $fileErrorInclusion;
        return;
    }

    public static function createPerms($id, $libellePerms, $codeAcces){ 
        self::$permissions[$libellePerms] = [
            "id" => $id,
            "titlePermission" => $libellePerms,
            "codePermission" => $codeAcces
        ];
    }

    public static function getPermissions(){
        foreach (self::$permissions as $key => $permission) {
            echo $key . " => " . $permission["codePermission"];
        }
    }

    public static function verifyAccess($sessionName, $codeAcces){
        Auth::verifAuth($sessionName);
        $codeAccesUser = $_SESSION["CodeAcces"];
        if($codeAccesUser < $codeAcces) {
            throw new Exception("L'utilisateur n'a pas l'autorisation d'accéder à cette ressource");
        }
    }
}