<?php

require_once __DIR__ . '/../vendor/autoload.php';
use SafePHP\AccessHandler;

$perms1 = AccessHandler::createPerms(1, "admin", 5);
$perms2 = AccessHandler::createPerms(2, "adjoint", 3);
$perms3 = AccessHandler::createPerms(3, "membre", 1);

$lesPerms = AccessHandler::getPermissions();

