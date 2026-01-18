<?php

namespace SafePHP;

class Exceptions {
    private static string $ErreurSignature = "<p style='color:red; font-weight: 600;'>Erreur, le fichier envoyé n'est pas au type demandé pour ";
    private static string $ErreurExtension = "<p style='color:red; font-weight: 600;'>Erreur, le fichier envoyé n'est pas au format demandé !</p>";
    private static string $ErreurFichierVide = "<p style='color:red; font-weight: 600;'>Rien n'a été envoyé !</p>";
    private static string $ErreurCustom;

    public static function setErreurCustom($AnError) : string {
        return self::$ErreurCustom = $AnError();
    }

    public static function getErreurSignature() : string {
        return self::$ErreurSignature;
    }

    public static function getErreurExtension(): string {
        return self::$ErreurExtension;
    }

    public static function getErreurFichierVide(): string {
        return self::$ErreurFichierVide;
    }
}