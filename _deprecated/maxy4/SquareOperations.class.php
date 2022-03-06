<?php

//require_once './SquareMaxy.class.php';

class SquareOperations
{
    function det($arr)
    {
        $size = $this->Order;

        switch ($size) {
            case 1:
                return $this->det1($arr);
                break;

            case 2:
                return $this->det2($arr);
                break;

            case 3:
                return $this->det3($arr);
                break;

            default:
                return $this->laplace($arr);
                break;
        }
    }

    function laplace($arr, $fila = "i=0")
    {
        /*
          $x = explode("=", $fila);

          switch ($x[0])
          {
          case "i":
          ;
          break;

          case "j":
          ;
          break;

          default:
          ;
          break;
          }

         */
        $size = count($arr[0]);

        $det = 0;
        for ($j = 0; $j < $size; $j++) {
            $det += $arr[0][$j] * $this->cofactor($arr, 0, $j);
        }

        return $det;
    }

    function det1($arr)
    {

        if ($this->Order != 1) {
            return "Error 11: The Matrix must be in 1st order.";
        } else {
            //Unique
            $det = $arr[0][0];

            return $det;
        }
    }

    function det2($arr)
    {

        if ($this->Order != 2) {
            return "Error 12: The Matrix must be in 2nd order.";
        } else {
            //Main - Secondary
            $det = ($arr[0][0] * $arr[1][1]) - ($arr[0][1] * $arr[1][0]);

            return $det;
        }
    }

    function det3($arr)
    {

        if ($this->Order != 3) {
            return "Error 13: The Matrix must be in 3rd order.";
        } else {
            //Main
            $dp = $arr[0][0] * $arr[1][1] * $arr[2][2];
            $dp += $arr[0][1] * $arr[1][2] * $arr[2][0];
            $dp += $arr[0][2] * $arr[1][0] * $arr[2][1];

            //Secondary
            $sec = $arr[0][2] * $arr[1][1] * $arr[2][0]; //ok
            $sec += $arr[0][0] * $arr[1][2] * $arr[2][1]; //ok
            $sec += $arr[0][1] * $arr[1][0] * $arr[2][2]; //ok

            $det = $dp - $sec; // Main - Secondary
            return $det;
        }
    }

    function quick_less_complem($arr)
    {
        $check = $this->check_square_matrix($arr);

        if ($check != "Success") {
            return $check;
        }

        array_shift($arr); // Erases first row

        for ($i = 0; $i < count($arr); $i++) {
            array_shift($arr[$i]); // erases first elements of each row
        }

        return $arr;
    }

    function less_complem($arr, $iA, $jA)
    {

        $horizontal_size = count($arr);

        for ($i = 0; $i < $horizontal_size; $i++) {
            if ($i == $iA) {
                unset($arr[$i]);
            } else {
                $vertical_size = count($arr[$i]);

                for ($j = 0; $j < $vertical_size; $j++) {
                    if ($j == $jA) {
                        unset($arr[$i][$j]);
                    }
                }
            }
        }

        $new_matrix1 = array_values($arr);
        $new_matrix2 = $this->_organize($new_matrix1);
        $det = $this->det($new_matrix2);

        return $det;
    }

    /**
     * Organizes the matrices positions
     * @param array $arr
     * @return array
     */
    function _organize($arr)
    {
        $new_matrix = array();
        $size = count($arr);

        for ($i = 0; $i < $size; $i++) {
            $new_matrix[$i] = array_values($arr[$i]);
        }

        return $new_matrix;
    }

    function cofactor($arr, $i, $j)
    {
        # Aij = (-1)^i+j * less_complem($arr, $i, $j);

        $value = pow(-1, $i + $j) * $this->less_complem($arr, $i, $j);

        return $value;
    }
}