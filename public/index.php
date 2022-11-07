<?php

require "../vendor/autoload.php";

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use DI\ContainerBuilder;
use GuzzleHttp\Psr7\ServerRequest;
use Kumaa\Framework\App;

$builder = new ContainerBuilder();
$builder->addDefinitions(dirname(__DIR__).'/configs/config.php');
$container = $builder->build();

$modules = [
    \Kumaa\Modules\Article\Article::class
];

$app = new App($container, $modules);

$response = $app->run(ServerRequest::fromGlobals());

Http\Response\send($response);
