<?php
namespace SafePHP;
use SafePHP\Database;
class FileInclusion {
    public static function includeFile($File, $FileDirection = null, $SQLRequest = null){
        //Si un chemin est défini
        if($FileDirection != null) {
           //Déplacement du fichier
        } elseif($SQLRequest != null) {
            return Database::InsertSQL($SQLRequest);
        }

        if(($FileDirection != null) && ($SQLRequest != null)) {
            throw new \BadFunctionCallException("Merci de ne choisir qu'une seule option (Chemin d'accès ou requête SQL) !");
        }

        if(($FileDirection === null) && ($SQLRequest === null)){
            throw new \BadFunctionCallException("Merci de choisir une option (Chemin d'accès ou requête SQL) !");
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

    public static function recreateImage($FileName, $tmpFilePath) {
        if($FileName != null) {
            self::verifySignatureImage($FileName);
            self::reSizeImage($FileName);
            self::renameFile($tmpFilePath, $FileName);
            return self::includeFile($FileName);
         }
    }

    /**
     * Redimensionne une image pour convenir à un standard par rapport ay type (MIME) d'image
     * @param string $File le chemin de l'image
     * @return void
     */
    public static function reSizeImage($File) {
        //Récupération du contenu de l'image
        $FileContent = file_get_contents($File);
        $SizeFile = getimagesize($FileContent);
        
        //Récupération des dimensions de l'image
        $largeur = $SizeFile[0];
        $longeur = $SizeFile[1];

        //Re-création de l'image dite 'vierge' en mémoire
        $newImage = imagecreatetruecolor($largeur / 2,  $longeur / 2);

        //On adapte la création de l'image en fonction de sa signature (type d'image)
        switch($SizeFile["mime"]){
            case "image/png":
                $imageSource = imagecreatefrompng($File);
                break;
            case "image/jpeg":
                $imageSource = imagecreatefromjpeg($File);
                break;
            default:
                die("Format incompatible !");
        }

        //Recopie de l'image créée dans le switch sur l'image dite 'vierge'
        
        $copyImage = imagecopyresampled(
            $newImage, //Image finale
            $imageSource, //Image initiale
            0,
            0,
            0,
            0,
            $largeur / 4,
            $longeur / 4,
            $largeur,
            $longeur
        );

        switch ($SizeFile["mime"]) {
            case "image/png":
                $uploadImage = imagepng($newImage, __DIR__ . "/.tmp" . $File);
                break;
            case "image/jpeg":
                $uploadImage = imagejpeg($newImage, __DIR__ . "/.tmp" . $File);
                break;
        }

        imagedestroy($imageSource);
        imagedestroy($newImage);

        return $uploadImage;
    }
}