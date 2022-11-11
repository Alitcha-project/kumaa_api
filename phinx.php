<?php

$migration = [
    \Kumaa\Modules\Commentaire\Commentaire::MIGRATION,
    \Kumaa\Modules\Article\Article::MIGRATION
];

$seed = [
    \Kumaa\Modules\Commentaire\Commentaire::SEED,
    \Kumaa\Modules\Article\Article::SEED
];


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . 'configs');
$dotenv->load();

return
[
    'paths' => [
        'migrations' => $migration,
        'seeds' => $seed
    ],
    'environments' => [
        // 'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        // 'production' => [
        //     'adapter' => 'mysql',
        //     'host' => 'localhost',
        //     'name' => 'production_db',
        //     'user' => 'root',
        //     'pass' => '',
        //     'port' => '3306',
        //     'charset' => 'utf8',
        // ],
        'development' => [
            'adapter' => 'mysql',
            'host' => $_ENV["DB_HOST"],
            'name' => $_ENV["DB_NAME"],
            'user' => $_ENV["DB_USERNAME"],
            'pass' => $_ENV["DB_PSW"],
            'port' => '3306',
            'charset' => 'utf8',
        ],
    //     'testing' => [
    //         'adapter' => 'mysql',
    //         'host' => 'localhost',
    //         'name' => 'testing_db',
    //         'user' => 'root',
    //         'pass' => '',
    //         'port' => '3306',
    //         'charset' => 'utf8',
    //     ]
    ],
    // 'version_order' => 'creation'
];
