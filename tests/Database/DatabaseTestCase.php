<?php

// namespace Tests\Database;

// use PDO;
// use Phinx\Config\Config;
// use Phinx\Migration\Manager;
// use PHPUnit\Framework\TestCase;
// use Symfony\Component\Console\Input\StringInput;
// use Symfony\Component\Console\Output\NullOutput;

// class DatabaseTestCase extends TestCase
// {
//     protected $pdo;

//     public function setUp(): void
//     {
//         $pdo = new PDO('sqlite::memory:', null, null, [
//             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//         ]);

//         $array_config = require('phinx.php');
//         $array_config['environments']['testing'] = [
//             'adapter' => 'sqlite',
//             'connection' => $pdo
//         ];

//         $config = new Config($array_config);
//         $manager = new Manager($config, new StringInput(''), new NullOutput());
//         $manager->migrate('testing');
//         $manager->seed('testing');

//         $this->pdo = $pdo;
//     }
// }
