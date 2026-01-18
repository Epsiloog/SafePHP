<?php
require_once __DIR__ . '/../vendor/autoload.php';
use SafePHP\SRI;

$CSSFile = "./styles/main.css";

echo htmlspecialchars(SRI::createSRI("css", $CSSFile));