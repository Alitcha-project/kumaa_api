<?php

namespace Kumaa\Modules\Discussion;

use Kumaa\Action\CrudAction;
use PDO;

class DiscussionController extends CrudAction
{
    public function __construct(PDO $pdo)
    {
        $this->model = new DiscussionModel($pdo);
        // $this->field_allow = []; Mieux penser la migration pour le remplir
    }
}
