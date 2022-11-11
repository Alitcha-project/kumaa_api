<?php

use Phinx\Seed\AbstractSeed;
use Faker\Factory;

/**
 * AddCommentaire
 */
class AddCommentaire extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [];

        $faker = Factory::create("fr_FR");
        $date = $faker->unixTime('now');
        

        for ($i=0; $i < 100; $i++) {
            $data[] = [
                "text_commentaire" => $faker->text(),
                "date_post_commentaire" => date('Y-m-d H:i:s', $date),
                "date_edit_commentaire" => date('Y-m-d H:i:s', $date),
            ];
        }

        $this->table('commentaires')
            ->insert($data)
            ->saveData();
    }
}
