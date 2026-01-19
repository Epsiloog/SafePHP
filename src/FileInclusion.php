<?php
namespace SafePHP;
use SafePHP\Database;
class FileInclusion {
    public static function includeFile($File, $FileDirection = null, $SQLRequest = null){
        //Si un chemin est défini
        if($FileDirection != null) {
           //Déplacement du fichier
        } elseif($SQLRequest != null) {
            Database::InsertSQL($SQLRequest);
        }

        if(($FileDirection != null) && ($SQLRequest != null)) {
            throw new \BadFunctionCallException("Merci de ne choisir qu'une seule option (Chemin d'accès ou requête SQL) !");
        }
    }

    public static function renameFile($tmpFilePath, $originalFileName){
        $TempDir = "./.tmp";
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

    public static function verifySignatureImage($File){
        return exif_imagetype($File);
    }

    public static function recreateImage($File) {
        
    }
}