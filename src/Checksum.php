<?php

namespace SafePHP;

class Checksum {
    public static function hashFile($FileDirection){
        return hash_file("sha256", $FileDirection);
    }

    public static function checksumFile(){

    }
}