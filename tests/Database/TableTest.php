<?php

namespace Tests\Database;

use Kumaa\Database\Table;
use PDO;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

use function PHPUnit\Framework\isInstanceOf;

class TableTest extends TestCase
{
    private $table;
    
    public function setUp():void
    {
        $pdo = new PDO('sqlite::memory:', null, null, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $this->table = new Table($pdo);

        $reflection = new ReflectionClass($this->table);
        $property_table = $reflection->getProperty('table');
        $property_table->setAccessible(true);
        $property_table->setValue($this->table, 'test');
    
        $this->table->getPdo()->exec('CREATE TABLE test(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            field VARCHAR(256)
        );');
    }

    public function testFind()
    {
        $this->table->getPdo()->exec("INSERT INTO test (field) VALUES ('data1'), ('data2')");

        $result = $this->table->getAll();

        $this->assertIsArray($result);

        $this->assertEquals("data1", $result[0]['field']);
        $this->assertEquals("data2", $result[1]['field']);
    }

    public function testNoFind()
    {
        $result = $this->table->getAll();

        $this->assertIsArray($result);
        $this->assertEquals(0, count($result));
    }

    public function testFindOne()
    {
        $this->table->getPdo()->exec("INSERT INTO test (field) VALUES ('data1'), ('data2')");

        $result = $this->table->get(1);
        $result2 = $this->table->get(3);

        $this->assertIsArray($result);

        $this->assertEquals("data1", $result[0]['field']);
        $this->assertEquals(0, count($result2));
    }

    public function testInsert()
    {
        $this->assertTrue($this->table->insert([
            'field' => 'good'
        ]));

        $this->assertEquals('good', $this->table->get(1)[0]['field']);
    }

    public function testDelete()
    {
        $this->assertTrue($this->table->insert([
            'field' => 'good'
        ]));

        $this->assertTrue($this->table->delete(1));

        $this->assertEmpty($this->table->getAll());
    }


    public function testUpdate()
    {
        $this->assertTrue($this->table->insert([
            'field' => 'good'
        ]));

        $this->assertTrue($this->table->update(1, ['id' => 100, 'field' => 'no good']));

        $this->assertNotEmpty($this->table->get(100));

        $this->assertEquals(100, $this->table->get(100)[0]['id']);
    }
}
