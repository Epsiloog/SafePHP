<?php
    namespace SafePHP;

class AntiCommands {

    /**
     * @param string $Input path of the file
     * @return string the escaped string
     */
    public static function deleteShellArgs($Input){
        return $filterAntiCommand = escapeshellarg($Input);
    }

    /**
     * @param string $Input path of the file
     * @return string the escaped string
     */
    public static function deleteShellCmd($Input){
        return $filterAntiCommand = escapeshellcmd($Input);
    }
}