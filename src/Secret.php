<?php

namespace SafePHP;

use Dotenv\Dotenv;

class Secret {
    private string $envPath;

    public function __construct(string $anEnvPath){
        $this->envPath = $anEnvPath;
    }

    public function getEnv() {
        $dotenv = Dotenv::createImmutable($this->envPath);
        $dotenv->load();
    }
}