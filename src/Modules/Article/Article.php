<?php

namespace Kumaa\Modules\Article;

use Kumaa\Framework\Router\Router;
use Kumaa\Modules\Module;
use PDO;
use Psr\Container\ContainerInterface;

class Article extends Module
{
    const MIGRATION = __DIR__ . '/db/migration';
    const SEED = __DIR__ . '/db/seeds';

    public function __construct(Router $router, ContainerInterface $container)
    {
        parent::__construct($router);

        $this->router->addRoute(
            "/article",
            [$container->get(ArticleController::class), "actionGet"],
            "getAllArticle",
            "GET"
        );

        $this->router->addRoute(
            "/article/{id}",
            [$container->get(ArticleController::class), "actionGet"],
            "getOneArticle",
            "GET"
        );

        $this->router->addRoute(
            "/article/{id}",
            [$container->get(ArticleController::class), "actionDelete"],
            "deleteOneArticle",
            "DELETE"
        );
    }
}
