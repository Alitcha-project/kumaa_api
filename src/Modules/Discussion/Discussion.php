<?php

namespace Kumaa\Modules\Discussion;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Kumaa\Framework\Router\Router;
use Kumaa\Modules\Module;
use PDO;
use Psr\Container\ContainerInterface;
require('DiscussionController.php');


class Discussion extends Module
{
    const MIGRATION = __DIR__ . '/db/migration';
    const SEED = __DIR__ . '/db/seeds';

    public function __construct(Router $router, ContainerInterface $container)
    {
        parent::__construct($router);

        $this->router->addRoute("/discussion/all", [$container->get(DiscussionController::class), "getAllDiscussions"], "getAllDiscussions", "GET");
        $this->router->addRoute("/discussion/{id}/show", [$container->get(DiscussionController::class), "getDiscussionById"], "getDiscussionById", "GET");
    }
}
