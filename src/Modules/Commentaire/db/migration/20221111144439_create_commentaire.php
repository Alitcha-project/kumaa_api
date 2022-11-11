<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class CreateCommentaire extends AbstractMigration
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
        $commentaires = $this->table('commentaires');
        $commentaires->addColumn("text_commentaire", "text", ["limit" => MysqlAdapter::TEXT_LONG]);
        $commentaires->addColumn("date_post_commentaire", "datetime");
        $commentaires->addColumn("date_edit_commentaire", "datetime");
        $commentaires->create();
    }
}
