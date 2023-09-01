<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Maxy\Matrix;
use Exception;
use TypeError;

class MatrixTest extends TestCase
{
    protected $defaultMatrix = [
        [1,2,3],
        [4,5,6],
        [7,8,9],
        [10,11,12],
    ];

    protected $defaultMatrixSerialized = 'O:11:"Maxy\Matrix":4:{i:0;a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}i:1;a:3:{i:0;i:4;i:1;i:5;i:2;i:6;}i:2;a:3:{i:0;i:7;i:1;i:8;i:2;i:9;}i:3;a:3:{i:0;i:10;i:1;i:11;i:2;i:12;}}';

    // test only to ensure it will create the instance without errors
    public function testLoadTheMatrix() 
    {
        $array = [
            [1,2,3],
            [4,5,6]
        ];

        $matrix = new Matrix($array);
        $this->assertInstanceOf(Matrix::class, $matrix);
    }

    public function testForRowsThatAreNotArrays() 
    {
        $this->expectException(Exception::class) || $this->expectException(TypeError::class);

        $array = [
            [1,2,3],
            'John Doe',
            [4,5,6],
        ];

        new Matrix($array);
    }

    public function testArrayEmptyAsParam() 
    {
        $this->expectException(Exception::class);
        $array = [];

        new Matrix($array);
    }

    public function testForEmptyRow()
    {
        $this->expectException(Exception::class);
        $array = [
            [1,2,3],
            [],
            [3,4,5],
        ];

        new Matrix($array);
    }

    public function testForInvalidElementTypes()
    {
        $this->expectException(Exception::class);
        $array = [
            [1,2,3],
            [1,'a',6],
        ];

        new Matrix($array);
    }

    public function testForIrregularMatrixSize()
    {
        $this->expectException(Exception::class);
        
        $array = [
            [1,2,3],
            [4,5,6,7],
            [8,9],
        ];

        new Matrix($array);
    }

    public function testSerialization() 
    {
        $matrix = new Matrix($this->defaultMatrix);
        $serialized = serialize($matrix);
        $this->assertEquals($this->defaultMatrixSerialized, $serialized);
    }

    public function testUnserialization() 
    {
        $classUnserialized = unserialize($this->defaultMatrixSerialized);

        $this->assertInstanceOf(Matrix::class, $classUnserialized);
        $matrix = new Matrix($this->defaultMatrix);

        $this->assertEquals($classUnserialized, $matrix);
        $this->assertEquals($classUnserialized->toArray(), $matrix->toArray());
    }

    public function testIfNumberOfRows()
    {
        $matrix = new Matrix($this->defaultMatrix);
        $this->assertEquals(count($matrix), 4);
        $this->assertEquals($matrix->countRows(), 4);
    }

    public function testNumberOfColumns()
    {
        $matrix = new Matrix($this->defaultMatrix);
        $this->assertEquals($matrix->countColumns(), 3);
    }

    public function testGetRow()
    {
        $matrix = new Matrix($this->defaultMatrix);
        $this->assertEquals($matrix->getRow(2), [7,8,9]);
    }

    public function testGetColumn()
    {
        $matrix = new Matrix($this->defaultMatrix);
        $this->assertEquals($matrix->getColumn(2), [3,6,9,12]);
    }

    public function testDumpArray()
    {
        $matrix = new Matrix($this->defaultMatrix);
        $this->assertEquals($matrix->toArray(), $this->defaultMatrix);
    }
}