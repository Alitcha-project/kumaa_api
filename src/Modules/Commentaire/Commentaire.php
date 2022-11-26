<?php

namespace Kumaa\Modules\Commentaire;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Kumaa\Framework\Router\Router;
use Kumaa\Modules\Module;
use PDO;
use Psr\Container\ContainerInterface;

require('CommentaireController.php');

class Commentaire extends Module
{
    const MIGRATION = __DIR__ . '/db/migration';
    const SEED = __DIR__ . '/db/seeds';

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(Router $router, ContainerInterface $container)
    {
        parent::__construct($router);

        $this->router->addRoute(
            "/commentaire/{id}/show",
            [$container->get(CommentaireController::class), "getById"],
            "getById",
            "GET"
        );

        $this->router->addRoute(
            "/commentaire/all",
            [$container->get(CommentaireController::class), "getAllCommentaire"],
            "getAllCommentaire",
            "GET"
        );

        $this->router->addRoute(
            "/commentaire/{id}/article",
            [$container->get(CommentaireController::class), "getAllByArticle"],
            "getAllByArticle",
            "GET"
        );
    }
}
