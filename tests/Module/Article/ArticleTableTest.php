<?php
namespace Tests\Module\Article;

use PDO;
use Phinx\Config\Config;
use Phinx\Migration\Manager;
use PHPUnit\Framework\TestCase;
use Kumaa\Modules\Article\ArticleModel;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;

class DatabaseTestCase extends TestCase
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

class ArticleTableTest extends DatabaseTestCase
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

        $data = $this->table->get(1);
        $this->assertIsArray($data);
        $this->assertNotEquals(0, count($data));
        $this->assertArrayHasKey('id', $data[0]);
    }

    public function testNotFind()
    {
        $data = $this->table->get(10000);
        $this->assertIsArray($data);
        $this->assertEquals([], $data);
    }

    public function testCreateArticle()
    {
        $data = $this->table->insert(['title_article' => "Test", 'text_article' => 'Bonjour tout le monde']);
        $this->assertEquals(true, $data);
    }

    public function testUpdateArticle()
    {
        $before = $this->table->get(1);
        $data = $this->table->update(1, ['title_article' => "Test"]);
        $after = $this->table->get(1);
        $this->assertTrue($data);
        $this->assertNotEquals($before, $after);
        $this->assertEquals("Test", $after[0]['title_article']);
    }

    public function testDeleteArticle()
    {
        $this->table->delete(1);
        $this->assertEquals([], $this->table->get(1));
    }
}
