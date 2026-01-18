<?php
namespace SafePHP;

class AntiCommands
{
    public static function deleteShellArgs($Input)
    {
        return $filterAntiCommand = escapeshellarg($Input);
    }

    public static function deleteShellCmd($Input)
    {
        return $filterAntiCommand = escapeshellcmd($Input);
    }

    /* ===============LISTE BLANCHE POUR LE ROUTEUR PHP======================
    $pages_whitelist = array(
        '1' => 'home.php',
        '2' => 'account.php',
        '3' => 'commands.php'
    );

    $page = $_GET['page'];
    if (array_key_exists($page, $pages_whitelist)) {
        include $pages_whitelist[$page];
    }
    else {
        erreur
    }
    */
}