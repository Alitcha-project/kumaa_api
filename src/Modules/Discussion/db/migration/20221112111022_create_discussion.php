<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateDiscussion extends AbstractMigration
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
        /*
         "text_discussion" => $faker->text(),
                "reply_to_discussion" => $faker->numerify(),
                "id_user_User" => $faker->numerify(),
                "id_comment_Categorie" => $faker->numerify(),
                "date_post_discussion" => date('Y-m-d H:i:s', $date),
                "date_edit_discussion" => date('Y-m-d H:i:s', $date),
        */
        $discussion = $this->table('discussion');
        $comment->addColumn("text_discussion", "string");
        $comment->addColumn("id_user_User", "integer");
        $comment->addColumn("id_comment_Categorie", "integer");
        $comment->addColumn("date_post_discussion", "datetime");
        $comment->addColumn("date_edit_discussion", "datetime");
        $comment->create();

    }
}
