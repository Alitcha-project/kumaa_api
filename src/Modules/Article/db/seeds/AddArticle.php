<?php

use Phinx\Seed\AbstractSeed;
use Faker\Factory;

/**
 * AddArticle
 */
class AddArticle extends AbstractSeed
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
                "title_article" => $faker->sentence(),
                "text_article" => $faker->text(),
                "date_post_article" => date('Y-m-d H:i:s', $date),
                "date_edit_article" => date('Y-m-d H:i:s', $date),
            ];
        }

        $this->table('articles')
            ->insert($data)
            ->saveData();
    }
}
