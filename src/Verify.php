<?php

namespace SafePHP;
use SafePHP\FileInclusion;
class Verify {
    public static function verify($input, $typeToHave) {
        switch($typeToHave) {
            case "bool":
                return is_bool($input) ? 1 : 0; //True = 1, fasle = 0
            
            case "integer":
                return is_integer($input) ? 1 : 0; //True = 1, fasle = 0

            case "float":
                return is_float($input) ? 1 : 0; //True = 1, fasle = 0

            case "int":
                return (is_int($input) || (is_numeric($input) && (int) $input == $input)) ? 1 : 0; //True = 1, fasle = 0

            case "double":
                return is_double($input) ? 1 :0; //True = 1, fasle = 0

            case "string":
                return is_string($input) ? 1 : 0; //True = 1, fasle = 0

            case "array":
                return is_array($input) ? 1 : 0; //True = 1, fasle = 0

            case "object":
                return is_object($input) ? 1 : 0; //True = 1, fasle = 0

            case "resource":
                return is_resource($input) ? 1 : 0; //True = 1, fasle = 0

            case "NULL":
                return is_null($input) ? 1 : 0; //True = 1, fasle = 0

            case "unknown type":
                return;

            default:
                return "null";
        }
    }
    
    public static function verifyExtension($File) {
        $Extension = pathinfo($File, PATHINFO_EXTENSION);
        if(in_array($Extension, FileInclusion::getImageFormatAviable())) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function verifySignatureFile($File){
        
    }
}