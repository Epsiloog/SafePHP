<?php

namespace SafePHP;

class Verify {
    public static function verify($Input, $TypeToHave) {
        switch($TypeToHave) {
            case "bool":
                return is_bool($Input) ? 1 : 0; //True = 1, fasle = 0
            
            case "integer":
                return is_integer($Input) ? 1 : 0; //True = 1, fasle = 0

            case "double":
                return is_double($Input) ? 1 :0; //True = 1, fasle = 0

            case "string":
                return is_string($Input) ? 1 : 0; //True = 1, fasle = 0

            case "array":
                return is_array($Input) ? 1 : 0; //True = 1, fasle = 0

            case "object":
                return is_object($Input) ? 1 : 0; //True = 1, fasle = 0

            case "resource":
                return is_resource($Input) ? 1 : 0; //True = 1, fasle = 0

            case "NULL":
                return is_null($Input) ? 1 : 0; //True = 1, fasle = 0

            case "unknown type":
                return;

            default:
                return "null";
        }
    }
}