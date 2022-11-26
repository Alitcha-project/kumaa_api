<?php

namespace Kumaa\Modules\Commentaire;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Kumaa\Framework\Router\Router;

class CommentaireController
{
    private $commentaire = null;
    private $pdo = null;
    private $router = null;

    use RouterHelper;

    public function __construct(CommentaireModel $commentaire, Router $router)
    {
        $this->commentaire = $commentaire;
        $this->router = $router;
    }

    //Le GetId, recupération d'une ligne de commentaire
    public function get(ServerRequest $request): Response
    {
        $result = $this->commentaire->getCommentaire();
        return new Response(200, []);
    }

    //Le GetAll, recupération de toute les lignes de commentaire
    public function getAll(ServerRequest $request): Response
    {
        $result = $this->commentaire->getCommentaire();

        return new Response(200, [], json_encode($result));
    }

    //GETBYARTICLE
    public function getAllCommentaireByArticle(ServerRequest $request): Response
    {
        $commentaire = $this->commentaire->getById($request->getAttribute('id'));

        if ($commentaire!= null) {
            return $this->redirect("getOneCommentaire", [
                "slug" => $commentaire["text_commentaire"],
                "id" => $request->getAttribute("id")
            ]);
        }

        return new Response(200, [], json_encode($commentaire));
    }
}
