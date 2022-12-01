<?php

namespace Kumaa\Modules\Discussion;

use PDO;
use Kumaa\Database\Table;

class DiscussionModel extends Table
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->table = 'discussion';
    }
}
