<?php

$migration = [
    \Kumaa\Modules\Article\Article::MIGRATION,
    \Kumaa\Modules\Comment\Comment::MIGRATION,
    \Kumaa\Modules\Discussion\Discussion::MIGRATION
];

$seed = [
    \Kumaa\Modules\Article\Article::SEED,
    \Kumaa\Modules\Comment\Comment::SEED,
    \Kumaa\Modules\Discussion\Discussion::SEED,
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

    ],
    // 'version_order' => 'creation'
];
