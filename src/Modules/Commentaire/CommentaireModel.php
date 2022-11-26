<?php
namespace Kumaa\Modules\Commentaire;

use Kumaa\Modules\Table;
use PDO;

class CommentaireModel extends Table
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->table = 'commentaires';
    }
}
