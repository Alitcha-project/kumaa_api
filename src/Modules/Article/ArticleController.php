<?php

namespace Kumaa\Modules\Article;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
// use Kumaa\Framework\Helper\RouterAction;
use Kumaa\Framework\Helper\RouterHelper;
use Kumaa\Framework\Router\Router;

class ArticleController
{
    private $article = null;
    private $router = null;

    use RouterHelper;

    public function __construct(ArticleModel $article, Router $router)
    {
        $this->article = $article;
        $this->router = $router;
    }

    public function getAllArticle(ServerRequest $request): Response
    {
        $result = $this->article->getArticle();

        return new Response(200, [], json_encode($result));
    }

    public function getArticleByIdAndSlug(ServerRequest $request): Response
    {
        $article = $this->article->getArticleById($request->getAttribute('id'));

        if ($article["title_article"] !== $request->getAttribute("slug")) {
            return $this->redirect("getOneArticle", [
                "slug" => $article["title_article"],
                "id" => $request->getAttribute("id")
            ]);
        }

        return new Response(200, [], json_encode($article));
    }
}
