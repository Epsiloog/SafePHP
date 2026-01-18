<?php

namespace SafePHP;

class SRI {
    public static function hashSRI($FileContent) {
        $hash = hash("sha384", $FileContent, true);
        $hash_base64 = base64_encode($hash);
        return "sha384-$hash_base64";
    }

    public static function createSRI($InputType, $FileDirection) {
        $FileContent = file_get_contents($FileDirection);
        $SRIHash = self::hashSRI($FileContent);
        if($InputType === "css") {
            return  "<link rel='stylesheet' hrefg='" . $FileDirection . "' integrity='" . $SRIHash . "' crossorigin='anonymous'>";
        } elseif($InputType === "js") {
            return  "<script src='" . $FileDirection ."' integrity='" . $SRIHash . "' crossorigin='anonymous'></script>";
        } else {
            return null;
        }
    }
}