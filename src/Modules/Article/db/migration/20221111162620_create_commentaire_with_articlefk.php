<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class CreateCommentaireWithArticlefk extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {

        $articles = $this->table('articles');
        $articles->addColumn("title_article", "string");
        $articles->addColumn("text_article", "text", ["limit" => MysqlAdapter::TEXT_LONG]);
        $articles->addColumn("date_post_article", "datetime");
        $articles->addColumn("date_edit_article", "datetime");
        $articles->create();

        $this->table('commentaires')
            ->addColumn('article_id_commentaire', 'integer', [
                'null'=>true
            ])
            ->addForeignKey('article_id_commentaire', 'articles', 'id', [
                'delete' =>'SET_NULL',
                'update' =>'NO_ACTION',
            ])
            ->update();
    }
}
