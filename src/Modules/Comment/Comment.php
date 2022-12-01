<?php

namespace Kumaa\Modules\Comment;

use Kumaa\Framework\Router\Router;
use Kumaa\Modules\Module;
use Psr\Container\ContainerInterface;

class Comment extends Module
{
    const MIGRATION = __DIR__ . '/db/migration';
    const SEED = __DIR__ . '/db/seeds';

    public function __construct(Router $router, ContainerInterface $container)
    {
        parent::__construct($router);

        $this->router->addRoute(
            "/comment",
            [$container->get(CommentController::class), "actionGet"],
            "getAllComment",
            "GET"
        );

        $this->router->addRoute(
            "/comment/{id}",
            [$container->get(CommentController::class), "actionGet"],
            "getOneComment",
            "GET"
        );
    }
}
