<?php

use Kumaa\Framework\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'config_db' => [
        'username' => $_ENV['DB_USERNAME'], 
        'password' => $_ENV['DB_PSW'],
        'db_name' => $_ENV['DB_NAME'],
        'host' => $_ENV['DB_HOST'],
    ],

    PDO::class => \DI\factory(\Kumaa\Framework\Factory\PDOFactory::class),

    // Router::class => \DI\factory(\Kumaa\Framework\Factory\RouterFactory::class)
];