<?php
namespace SafePHP;

class FileInclusion {
    public static function includeFile($File){

    }

    public static function renameFile($File){
        $NameFile = pathinfo($File, PATHINFO_FILENAME);
        $RandomName = bin2hex(random_bytes(24));
        $NewName = rename($NameFile, $RandomName);
        return $NewName;
    }

    public static function recreateImage($Image) {

    }

    public static function getImageFormatAviable() : array {
        return $AcceptPicturesFormat = ["png", "jpg", "jpeg", "svg"];
    }

    public static function verifySignatureImage($File){
        return exif_imagetype($File);
    }
}