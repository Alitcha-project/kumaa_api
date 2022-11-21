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
        $errors = (new Validator([
            'test' => '123456',
        ]))
        ->length('test', 1, 8)
        ->length('test', 0)
        ->length('test', 5, 8)
        ->length('test', null, 5)
        ->length('test', 4, null)
        ->length('test', 9, 10)
        ->length('test', 0, 2)
        ->length('test', null, null)
        ->length('test', 10)
        ->length('test', 0)
        ->getErrors();

        $this->assertCount(4, $errors);
    }
}
