<?php

namespace Kumaa\Modules\Comment;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;

class ArticleController
{
    private $pdo = null;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function getAllComment(ServerRequest $request): Response
    {
        $response = new Response();

        $result = $this->pdo->query("SELECT * FROM comments");
        if(!empty($result))
        {
            $data = $result->fetchAll();
            $data_json_form = json_encode($data);
            $response = $response->withStatus(200);
            $response->getBody()->write($data_json_form);
        }
        else
        {
            echo json_encode(array("alert" => "User not found"));
        }
        
        




        //Recuperer les donnes avec l'instance de pdo $this->pdo
        //Si tu as des donnes
        // Parse to json
        //Sinon tu cree un json de cette form
        // {
        //     "error": "No data"
        // }

        

       


        return $response;
    }
}