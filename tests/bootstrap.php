<?php

\error_reporting(E_ALL);

include_once \dirname(__DIR__) . '/vendor/autoload.php';

if (!\class_exists('Dotenv\Dotenv')) {
    throw new \RuntimeException('You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
}

$envFilePath = __DIR__ . '/../';

if (file_exists($envFilePath . '.env.test')) {
    $dotenv = Dotenv\Dotenv::create($envFilePath, '.env.test');
    $dotenv->load();
}
