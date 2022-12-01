<?php

namespace Tests\Module\Article;

use DI\Container;
use DI\ContainerBuilder;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Kumaa\Modules\Article\ArticleController;
use Kumaa\Modules\Article\ArticleModel;
use PHPUnit\Framework\TestCase;

use function DI\get;

class ArticleTest extends TestCase
{
    /**
     * article_controller
     *
     * @var ArticleController
     */
    public $article_controller;

    public function setUp():void
    {
        $container = $this->createMock(Container::class);
        $article = $this->createMock(ArticleModel::class);

        $container->method('get')->willReturn($article);

        $this->article_controller = new ArticleController($container);

    }

    public function testGetAllArticle()
    {
        $response = $this->article_controller->action_get(new ServerRequest(200, '/'));

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
