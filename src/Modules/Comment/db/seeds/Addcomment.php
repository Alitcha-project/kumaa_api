<?php

use Phinx\Seed\AbstractSeed;
use Faker\Factory;

/**
 * AddArticle
 */
class AddComment extends AbstractSeed
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
                "content" => $faker->text(),
                "id_user_User" => $faker->numerify(),
                // "id_article_Article" => $faker->numerify(),
                "date_post_comment" => date('Y-m-d H:i:s', $date),
                "date_edit_comment" => date('Y-m-d H:i:s', $date),
            ];
        }

        $this->table('comment')
            ->insert($data)
            ->saveData();
    }
}
