<?php

namespace SafePHP;

class AccessHandler {
    private string $accessHandlerDir = __DIR__ . "/AccessHandler/";

    public function __construct($errorCode, $fileErrorInclusion){
        echo http_response_code($errorCode);
        require_once self::$accessHandlerDir . $fileErrorInclusion;
        return;
    }
}