<?php

namespace Kumaa\Modules\Comment;

use Kumaa\Database\Table;
use PDO;

class CommentModel extends Table
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->table = 'comment';
    }
}
