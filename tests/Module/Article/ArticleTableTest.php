<?php

namespace Tests\Module\Article;

use Kumaa\Modules\Article\ArticleModel;
use PDO;
use Phinx\Config\Config;
use Phinx\Console\PhinxApplication;
use Phinx\Migration\Manager;
use phpDocumentor\Reflection\Types\Array_;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\NullOutput;
// use Tests\DBTestCase;


class DBTestCase extends TestCase
{
    protected $pdo;

    public function setUp(): void
    {
        $pdo = new PDO('sqlite::memory:', null, null, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $array_config = require('phinx.php');
        $array_config['environments']['testing'] = [
            'adapter' => 'sqlite',
            'connection' => $pdo
        ];

        $config = new Config($array_config);
        $manager = new Manager($config, new StringInput(''), new NullOutput());
        $manager->migrate('testing');
        $manager->seed('testing');

        $this->pdo = $pdo;
    }
}


class ArticleTableTest extends DBTestCase
{
        
    /**
     * table
     *
     * @var ArticleModel
     */
    private $table;

    public function setUp(): void
    {
        parent::setUp();
        $this->table = new ArticleModel($this->pdo);
    }

    public function testFind()
    {

        $count = (int)$this->pdo->exec('SELECT COUNT(id) FROM `articles`');
        $this->assertEquals(100, $count);

        $data = $this->table->getArticleById(1);
        $this->assertIsArray($data);
    }

    public function testNotFind()
    {
        $data = $this->table->getArticleById(10000);
        $this->assertNull($data);
    }
}
