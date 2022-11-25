<?php
namespace Kumaa\Modules\Article;

use Kumaa\Modules\Table;
use PDO;

class ArticleModel extends Table
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->table = 'articles';
    }
}
