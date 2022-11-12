<?php

use Phinx\Seed\AbstractSeed;
use Faker\Factory;

/**
 * AddArticle
 */
class AddDiscussion extends AbstractSeed
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
                "text_discussion" => $faker->text(),
                "reply_to_discussion" => $faker->numerify(),
                "id_user_User" => $faker->numerify(),
                "id_comment_Categorie" => $faker->numerify(),
                "date_post_discussion" => date('Y-m-d H:i:s', $date),
                "date_edit_discussion" => date('Y-m-d H:i:s', $date),
            ];
        }


        /*CREATE TABLE public."Discussion" (
            id_discussion smallint NOT NULL,
            text_discussion varchar NOT NULL,
            date_post_discussion date NOT NULL,
            date_edit_discussion date NOT NULL,
            "id_user_User" smallint NOT NULL,
            reply_to_discussion smallint,
            "id_comment_Categorie" smallint,
            CONSTRAINT "Article_pk" PRIMARY KEY (id_discussion)
        );*/

        $this->table('discussions')
            ->insert($data)
            ->saveData();
    }
}
