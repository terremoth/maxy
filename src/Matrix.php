<?php

declare(strict_types=1);

namespace Maxy;

use Maxy\Contracts\MatrixInterface;
use Countable;
use Exception;
use Serializable;

class Matrix implements MatrixInterface, Countable
{
    public array $main_array = []; 

    public function __construct(array $array) 
    {   
        $this->checkArrayForErrors($array);

        $this->main_array = $array;
    }

    protected function checkArrayForErrors(array $array) : void
    {
        $rows = count($array);
        $columnsQuantityEachRow = [];
        
        if ($rows == 0) {
            throw new Exception("The given array should have at least one element (one row and one column)");
        }

        for($row = 0; $row < $rows; $row++) {
        
            $columnsQuantityInThisRow = count($array[$row]);
            
            $columnsQuantityEachRow[$row] = $columnsQuantityInThisRow;
            
            if (!is_array($array[$row])) {
                throw new Exception("Row $row should be an array, ".gettype($array[$row])." given.");
            }
            
            if (empty($array[$row])) {
                throw new Exception("Invalid matrix: row $row is empty.");
            }

            for ($column = 0; $column < $columnsQuantityInThisRow; $column++) {
                
                $element = $array[$row][$column];
                
                if (!is_numeric($element)) {
                    throw new Exception("Element at row $row and column $column should be numeric, ".gettype($element)." type given.");
                }

            }
        }

        // every row should have the same quantity of columns:
        $areAllColumnsTheSameSize = (count(array_unique($columnsQuantityEachRow, SORT_REGULAR)) === 1);

        if (!$areAllColumnsTheSameSize) {
            throw new Exception("The array is not a matrix, because it is not rectangular (have different column sizes)");
        }

    }

    public function __serialize() : array
    {
        return $this->main_array;
    }

    public function __unserialize(array $data) : void
    {
        $this->checkArrayForErrors($data);
        $this->main_array = $data;
    }

    public function count(): int 
    {
        return $this->countRows();
    }

    public function countRows(): int 
    {
        return count($this->main_array);
    }

    public function getRow(int $rowNumber): array 
    {
        return $this->main_array[$rowNumber];
    }

    public function countColumns(): int 
    {
        return count($this->main_array[0]);
    }

    public function getColumn(int $columnNumber): array 
    {
        $columnGroup = [];

        foreach ($this->main_array as $row) {
            foreach ($row as $index => $column) {
            
                if ($index == $columnNumber) {
                    $columnGroup[] =  $column;
                }
            }
            
        }

        if (empty($columnGroup)) {
            throw new Exception('Column index out of range');
        }

        return $columnGroup;
    }

    public function toArray() : array 
    {
        return $this->main_array;
    }

    public function __toString() : string
    {
        $str = '';

        foreach ($this->main_array as $row) {
            $str .= '|';
            foreach ($row as $index =>  $item) {
                
                if ($index != 0) {
                    $str .= ',';
                }

                $str .= $item;
            }

            $str .= '|<br>';
        }

        return $str;
    }
}
