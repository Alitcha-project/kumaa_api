<?php

namespace Kumaa\Modules\Article;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;

class ArticleController
{
    private $pdo = null;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function get(ServerRequest $request): Response
    {
        var_dump($this->pdo);
        return new Response(200, []);
    }
}