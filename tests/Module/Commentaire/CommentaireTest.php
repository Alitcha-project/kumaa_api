<?php
namespace Module\Commentaire;

use DI\Container;
use DI\ContainerBuilder;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Kumaa\Modules\Commentaire\CommentaireController;
use Kumaa\Modules\Commentaire\CommentaireModel;
use PHPUnit\Framework\TestCase;

class CommentaireTest extends TestCase
{
    /**
     * commentaire_controller
     *
     * @var CommentaireController
     */
    public $commentaire_controller;

    public function setUp(): void
    {
        $container = $this->createMock(Container::class);
        $article = $this->createMock(CommentaireModel::class);

        $container->method('get')->willReturn($article);

        $this->commentaire_controller = new CommentaireController($container);
    }

    public function testGetAllArticle()
    {
        $response = $this->commentaire_controller->actionGet(new ServerRequest(200, '/'));

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
