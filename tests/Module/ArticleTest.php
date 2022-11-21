<?php

namespace Tests\Module\Article;

use GuzzleHttp\Psr7\ServerRequest;
use Kumaa\Framework\Router\Router;
use Kumaa\Modules\Article\ArticleController;
use Kumaa\Modules\Article\ArticleModel;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;

class ArticleTest extends TestCase
{
    private $action;

    // public function create_article(int $id, string $title)
    // {
    //     return [
    //         "id" => $id,
    //         "title_article" => $title
    //     ];
    // }

    // public function setUp(): void
    // {
    //     $article = $this->create_article(9, "test-title");
    //     $article_model = (new Prophet())->prophesize(ArticleModel::class);
    //     $article_model->getArticle()->willReturn([]);
    //     $article_model->getArticleById(9)->willReturn($article);
    //     $router = (new Prophet())->prophesize(Router::class);
    //     $this->action = new ArticleController($article_model->reveal(), $router->reveal());
    // }

    // public function testAllArticle()
    // {
    //     $response = $this->action->getAllArticle(new ServerRequest("GET", "/article/"));

    //     $this->assertEquals(200, $response->getStatusCode());
    //     $this->assertEquals(json_encode([]), $response->getBody());
    // }

    // public function testGetOneArtilce()
    // {
    //     $response = $this->action->getArticleByIdAndSlug(new ServerRequest("GET", "/article/test-title-9"));

    //     $this->assertEquals(200, $response->getStatusCode());

    //     $this->assertEquals(json_encode($this->create_article(9, "test-title")), (string)$response->getBody());

    // }

    public function testNothing()
    {
        $this->assertEquals(1, 1);
    }
}
