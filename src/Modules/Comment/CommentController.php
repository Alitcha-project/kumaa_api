<?php

namespace Kumaa\Modules\Comment;

use DI\Container;
use Kumaa\Action\CrudAction;

class CommentController extends CrudAction
{
    public function __construct(Container $container)
    {
        $this->model = $container->get(CommentModel::class);
        $this->field_allow = ['content'];
    }
}
