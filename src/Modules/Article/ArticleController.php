<?php

namespace Kumaa\Modules\Article;

use DI\Container;
use Kumaa\Action\CrudAction;

class ArticleController extends CrudAction
{
    public function __construct(Container $container)
    {
        $this->model = $container->get(ArticleModel::class);
        $this->field_allow = ['id', 'title_article', 'date_post_article', 'date_edit_article'];
    }
}
