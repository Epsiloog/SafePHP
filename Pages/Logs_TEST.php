<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

$logger = new Logger("channel_test");

$filerHandler = new StreamHandler(__DIR__ . "../SafePHP-Logs/test.logs", Level::Info);
$logger->pushHandler($filerHandler);

$logger->info("Hello World !");
$logger->error("Not Hello World !");