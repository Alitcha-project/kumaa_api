<?php
namespace Kumaa\Modules\Article;

use PDO;
use Kumaa\Database\Table;

/**
 * ArticleModel
 */
class ArticleModel extends Table
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->table = 'articles';
    }
}
