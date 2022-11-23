<?php
namespace Kumaa\Modules\Article;

class ArticleModel
{

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getArticle(): array
    {
        $query = $this->pdo->query("SELECT * FROM `articles` ORDER BY `date_post_article` LIMIT 10");
        $query->execute();
        $result = $query->fetchAll();

        return $result;
    }

    public function getArticleById(int $id): ?array
    {
        $query = $this->pdo->prepare("SELECT * FROM `articles` WHERE `id` = ?");
        $query->execute([$id]);

        $article = $query->fetch();

        return is_array($article) ? $article : null;
    }

    public function insertArticle(string $title, string $text): bool
    {
        $query = $this->pdo->prepare("INSERT INTO `articles` VALUES(?, ?, NOW(), NOW()");

        return $query->execute([$title, $text]);
    }
}
