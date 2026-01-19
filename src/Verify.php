<?php
namespace SafePHP;

class Verify {
    private static array $DocumentsFile = ["pdf", "doc", "docx", "txt", "odt", "ppt", "pptx"]; //Liste d'extension de documents valide
    private static array $ImagesFile = ["png", "jpeg", "jpg", "gif"]; //Liste d'extension d'image valide
    private static array $VideosFile = ["mov", "mp4", "m4a"]; //Liste d'extension vidéo valides

    //Liste des types MIME autorisés
    private static array $MimeTypes = [
        // Documents
        "pdf" => ["application/pdf"],
        "doc" => ["application/msword"],
        "docx" => [
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/zip" // docx est techniquement un zip
        ],
        "txt" => ["text/plain"],
        "odt" => [
            "application/vnd.oasis.opendocument.text",
            "application/zip"
        ],
        "ppt" => ["application/vnd.ms-powerpoint"],
        "pptx" => [
            "application/vnd.openxmlformats-officedocument.presentationml.presentation",
            "application/zip"
        ],
        // Images
        "png" => ["image/png"],
        "jpeg" => ["image/jpeg"],
        "jpg" => ["image/jpeg"],
        "gif" => ["image/gif"],
        // Videos
        "mov" => ["video/quicktime"],
        "mp4" => ["video/mp4"],
        "m4a" => ["audio/mp4", "audio/x-m4a"]
    ];

    /**
     * Donne une liste d'extension en fonction du type de fichier choisi
     * @param string $AType Le type de fichier attendu (Documents, Images, Videos)
     * @return array Retourne la liste d'extension de fichiers
     */
    public static function getTypeFileAviable($AType): array {
        switch ($AType) {
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

    /**
     * Vérifie le type de valeur envoyée
     * @param string $input La valeur à vérifier
     * @param string $typeToHave Le type de valeur à obtenir
     * @return int|string retourne 1 si le type vérifié est correct, sinon faux, si le type demandé est inconnu, alors la fonction renvoie null
     */
    public static function verify($input, $typeToHave){
        switch ($typeToHave) {
            case "bool":
                return is_bool($input) ? 1 : 0;
            case "integer":
                return is_integer($input) ? 1 : 0;
            case "float":
                return is_float($input) ? 1 : 0;
            case "int":
                return (is_int($input) || (is_numeric($input) && (int) $input == $input)) ? 1 : 0;
            case "double":
                return is_double($input) ? 1 : 0;
            case "string":
                return is_string($input) ? 1 : 0;
            case "array":
                return is_array($input) ? 1 : 0;
            case "object":
                return is_object($input) ? 1 : 0;
            case "resource":
                return is_resource($input) ? 1 : 0;
            case "NULL":
                return is_null($input) ? 1 : 0;
            case "unknown type":
                return "null";
            default:
                return "null";
        }
    }


    /**
     * Vérifie l'extension de l'image envoyée
     * @param string  $File Le type fichier à analyser
     * @return int retourne 1 si l'extension du fichier est dans la liste des formats acceptés, sinon 0
     */
    public static function verifyExtensionImage($File){
        $Extension = strtolower(pathinfo($File, PATHINFO_EXTENSION));
        if (in_array($Extension, self::$ImagesFile)) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Vérifie la signature (type MIME) ET l'extension d'un fichier uploadé
     * Principe : LISTE BLANCHE STRICTE uniquement
     * 
     * @param string $FileTmpName Le chemin temporaire du fichier uploadé
     * @param string $FileName Le nom original du fichier
     * @param string $FileType Le type de fichier attendu (Documents, Images, Videos)
     * @return bool
     */
    public static function verifySignatureFile($FileTmpName, $FileName, $FileType){
        if (!is_uploaded_file($FileTmpName)) {
            return false;
        }

        $Extension = strtolower(pathinfo($FileName, PATHINFO_EXTENSION));

        $AllowedExtensions = self::getTypeFileAviable($FileType);
        if (!in_array($Extension, $AllowedExtensions)) {
            return false;
        }

        if (!isset(self::$MimeTypes[$Extension])) {
            return false;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $detectedMimeType = finfo_file($finfo, $FileTmpName);

        $allowedMimeTypesForExtension = self::$MimeTypes[$Extension];

        if (!in_array($detectedMimeType, $allowedMimeTypesForExtension)){
            return false;
        }
        return true;
    }
}