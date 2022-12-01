<?php

namespace Kumaa\Modules\Discussion;

use Kumaa\Modules\Module;
use Kumaa\Framework\Router\Router;
use Psr\Container\ContainerInterface;
use Kumaa\Modules\Discussion\DiscussionController;


class Discussion extends Module
{
    const MIGRATION = __DIR__ . '/db/migration';
    const SEED = __DIR__ . '/db/seeds';

    public function __construct(Router $router, ContainerInterface $container)
    {
        parent::__construct($router);

        $this->router->addRoute(
            "/discussion/",
            [
                $container->get(DiscussionController::class),
                "actionGet"
            ],
            "getAllDiscussions",
            "GET"
        );

        $this->router->addRoute(
            "/discussion/{id}",
            [
                $container->get(DiscussionController::class),
                "actionGet"
            ],
            "getDiscussionById",
            "GET"
        );
    }
}
