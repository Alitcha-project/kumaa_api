<?php

namespace Kumaa\Modules\Commentaire;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;

class CommentaireController
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