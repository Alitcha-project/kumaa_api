<?php


use Phinx\Seed\AbstractSeed;
use Faker\Factory;

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

        $faker = Factory::create("fr_FR");
        $date = $faker->unixTime('now');

        $commentaires = [];
        $articles = [];
        for ($i=0; $i < 20; $i++) {
            $articles[] = [
                "title_article" => $faker->sentence(),
                "text_article" => $faker->text(),
                "date_post_article" => date('Y-m-d H:i:s', $date),
                "date_edit_article" => date('Y-m-d H:i:s', $date),
            ];
        }

        $this->insert('articles', $articles) ;
        $articles = array_map(
            function ($article) {
                return $article['id'];
            },
            $this->fetchAll('SELECT id FROM articles')
        );

        for ($i=0; $i < 100; $i++) {
            $commentaires[] = [
                'text_commentaire' => $faker->sentence(4),
                'date_post_commentaire' => date('Y-m-d H:i:s', $date),
                'date_edit_commentaire' => date('Y-m-d H:i:s', $date),
                'article_id_commentaire' => $articles[rand(0, 19)]
            ];
        }
        $this->insert('commentaires', $commentaires);
    }
}
