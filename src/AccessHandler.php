<?php

namespace SafePHP;

use Exception;

class AccessHandler {
    private static array $permissions = [
        "id" => null,
        "titlePermission" => null,
        "codePermission" => null
    ];
    
    /**
     * Folder direction of error pages
     * @var string
     */
    private string $accessHandlerDir = __DIR__ . "/AccessHandler/";

    /**
     * Create a response  on client and server side
     * @param int $errorCode codeto give as http response
     * @param string $fileErrorInclusion path of the error file on the folder defined by $accessHandlerDir
     * @return void
     */
    public function __construct($errorCode, $fileErrorInclusion){
        echo http_response_code($errorCode);
        require_once self::$accessHandlerDir . $fileErrorInclusion;
        return;
    }

    /**
     * /
     * @param int $id code on the arraylist (to avoid duplication)
     * @param string $libellePerms title of the role/permission
     * @param int $codeAcces level of access granteed
     * @return void
     */
    public static function createPerms($id, $libellePerms, $codeAcces){ 
        self::$permissions[$libellePerms] = [
            "id" => $id,
            "titlePermission" => $libellePerms,
            "codePermission" => $codeAcces
        ];
    }

    /**
     * Return every permissionsof every role
     * @return array
     */
    public static function getPermissions(){
        foreach (self::$permissions as $key => $permission) {
            echo $key . " => " . $permission["id"];
            echo $key . " => " . $permission["titlePermission"];
            echo $key . " => " . $permission["codePermission"];
        }

        return $permission;
    }

    /**
     * Verify if the actual user can access a ressource by comparing his access's level
     * @param string $sessionName name of the session (username)
     * @param int $codeAcces to have to pass
     * @throws Exception if false
     * @return void Return code 200
     */
    public static function verifyAccess($sessionName, $codeAcces){
        Auth::verifAuth($sessionName);
        $codeAccesUser = $_SESSION["CodeAcces"];
        if($codeAccesUser < $codeAcces) {
            throw new Exception("L'utilisateur n'a pas l'autorisation d'accéder à cette ressource");
        } else {
            return http_response_code(200);
        }
    }
}