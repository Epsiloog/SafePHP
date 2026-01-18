<?php
namespace SafePHP;

class FileInclusion {
    public static function includeFile($File){

    }

    public static function renameFile($tmpFilePath, $originalFileName)
    {
        $TempDir = "./tmp";
        $ExtensionFile = pathinfo($originalFileName, PATHINFO_EXTENSION);

        $RandomName = bin2hex(random_bytes(24));
        $NewFilePath = "$TempDir/$RandomName.$ExtensionFile";

        $Movefile = move_uploaded_file($tmpFilePath, $NewFilePath);

        if ($Movefile) {
            echo "Déplacement du fichier réussi !";
            return $NewFilePath;
        } else {
            echo "Erreur lors du déplacement de fichier";
            return false;
        }
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