<?php

namespace Tests\Framework;

use Kumaa\Framework\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testRequired()
    {
        $errors = (new Validator([
            'name' => 'test',
            'another' => 'content'
        ]))
            ->require('name', 'content')
            ->getErrors();

        $this->assertCount(1, $errors);
    }

    public function testRequiredSucces()
    {
        $errors = (new Validator([
            'name' => 'test',
            'another' => ''
        ]))
            ->require('name', 'another')
            ->getErrors();

        $this->assertCount(0, $errors);
    }

    public function testTitleSuccess()
    {
        $errors = (new Validator([
            'title' => 'test',
        ]))
            ->title('title')
            ->getErrors();

        $this->assertCount(0, $errors);
    }

    public function testTitleEchec()
    {
        $errors = (new Validator([
            'title1' => 'test.',
            'title2' => 'Tes..'
        ]))
            ->title('title1')
            ->title('title2')
            ->getErrors();

        $this->assertCount(2, $errors);
    }

    public function testNotEmpty()
    {
        $errors = (new Validator([
            'title1' => '',
            'title2' => 'Tes..'
        ]))
            ->notEmpty('title1')
            ->notEmpty('title2')
            ->getErrors();

        $this->assertCount(1, $errors);
    }

    public function testLength()
    {
        $this->assertCount(0, (new Validator([
            'test' => '123456',
        ]))->length('test', 1, 8)->getErrors());
        $this->assertCount(0, (new Validator([
            'test' => '123456',
        ]))->length('test', 0)->getErrors());
        $this->assertCount(0, (new Validator([
            'test' => '123456',
        ]))->length('test', 5, 8)->getErrors());
        $this->assertCount(1, (new Validator([
            'test' => '123456',
        ]))->length('test', null, 5)->getErrors());
        $this->assertCount(0, (new Validator([
            'test' => '123456',
        ]))->length('test', 4, null)->getErrors());
        $this->assertCount(1, (new Validator([
            'test' => '123456',
        ]))->length('test', 9, 10)->getErrors());
        $this->assertCount(1, (new Validator([
            'test' => '123456',
        ]))->length('test', 0, 2)->getErrors());
        $this->assertCount(0, (new Validator([
            'test' => '123456',
        ]))->length('test', null, null)->getErrors());
        $this->assertCount(1, (new Validator([
            'test' => '123456',
        ]))->length('test', 10)->getErrors());
        $this->assertCount(0, (new Validator([
            'test' => '123456',
        ]))->length('test', 0)->getErrors());
    }

    public function testDate()
    {
        $error = (new Validator(['date'=>'2018-04-01']))->dateTime('date')->getErrors();
        $this->assertCount(0, $error);

        $error = (new Validator(['date' => '2020-34-32']))->dateTime('date')->getErrors();
        $this->assertCount(1, $error);

        $error = (new Validator(['date' => '2010-12-12 00:23:56']))->dateTime('date', 'h:i:s d:m:Y')->getErrors();
        $this->assertCount(1, $error);

        $error = (new Validator(['date' => '2010-12-12 00:23:56']))->dateTime('date')->getErrors();
        $this->assertCount(0, $error);

        $error = (new Validator(['date' => '2010-12-12 25:23:56']))->dateTime('date')->getErrors();
        $this->assertCount(1, $error);
    }
}
