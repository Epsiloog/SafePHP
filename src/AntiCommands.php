<?php
namespace SafePHP;

class AntiCommands {
    public static function deleteShellArgs($Input)
    {
        return $filterAntiCommand = escapeshellarg($Input);
    }

    public static function deleteShellCmd($Input){
        return $filterAntiCommand = escapeshellcmd($Input);
    }
}