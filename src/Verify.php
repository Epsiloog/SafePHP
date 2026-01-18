<?php

namespace SafePHP;
use SafePHP\FileInclusion;
class Verify {
    private static array $DocumentsFile = ["pdf", "doc", "docx", "txt", "odt", "ppt", "pptx"];
    private static array $ImagesFile = ["png", "jpeg", "jpg", "gif"];
    private static array $VideosFile = ["mov", "mp4", "m4a"];

    public static function getTypeFileAviable($AType) : array {
        switch($AType) {
            case "Documents":
                return self::$DocumentsFile;

            case "Images":
                return self::$ImagesFile;

            case "Videos":
                return self::$VideosFile;

            default:
                return ["This type of file does not exist !"];
        }
    }

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
    
    public static function verifyExtensionImage($File) {
        $Extension = pathinfo($File, PATHINFO_EXTENSION);
        if(in_array($Extension, self::$ImagesFile)) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function verifySignatureFile($File, $FileType)
    {
        $ListTypeFile = self::getTypeFileAviable($FileType);

        // Vérifier si c'est un fichier uploadé
        if (is_uploaded_file($File)) {
            // Utiliser le chemin temporaire directement
            $TypeOfFile = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $File);

            // Vérifier si le type détecté est dans la liste autorisée
            if (in_array($TypeOfFile, $ListTypeFile)) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }
}