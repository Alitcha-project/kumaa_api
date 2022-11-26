<?php

namespace Kumaa\Modules\Discussion;

use GuzzleHttp\Psr7\src\Response;
use GuzzleHttp\Psr7\src\ServerRequest;

class DiscussionController
{
    private $pdo = null;
    private $article = null;
    private $router = null;
    use RouterHelper;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->article = $article;
    }
    
    public function getAllDiscussion(ServerRequest $request): Response
    {
        $response = new Response();

        $result = $this->pdo->query("SELECT * FROM discussions");
        if(!empty($result))
        {
            $data = $result->fetchAll();
            $data_json_form = json_encode($data);
            $response = $response->withStatus(200);
            $response->getBody()->write($data_json_form);
        }
        else
        {
            //echo json_encode(array("alert" => "Aucune discussion trouvée"));
            $response = $response->withStatus(204); //204 => 'No Content'
        }
        
        return $response;
    }

    public function getDiscussionById(ServerRequest $request): Response
    {
        $articles = $this->article->getArticleById();
            
        $result = ["article" =>$article];
            
        if(!empty($result))
        {
       
            
            $data = $result->fetchAll();
            $data_json_form = json_encode($data);
            $response = $response->withStatus(200);
            $response->getBody()->write($data_json_form);
        }
        else
        {
            
            $response = $response->withStatus(204); //204 => 'No Content'
        }
        return $response;
    }
}