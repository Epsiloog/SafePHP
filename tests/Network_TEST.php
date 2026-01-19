<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SafePHP\Network;

$ip = Network::getClientIP();

if (Network::getIPv4($ip)) {
    echo "IPv4 : $ip";
} else {
    echo "IPv6 : $ip (ce client n'a pas d'IPv4)";
}