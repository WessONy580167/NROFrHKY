<?php
// 代码生成时间: 2025-08-23 23:07:55
class Math_Tools {

    /**
     * Calculate the sum of two numbers.
     *
     * @param float $number1 The first number.
     * @param float $number2 The second number.
     * @return float|int The sum of the two numbers.
     */
    public function add($number1, $number2) {
        if (!is_numeric($number1) || !is_numeric($number2)) {
            // Handle error: Invalid input
            throw new InvalidArgumentException('Both arguments must be numeric values.');
        }

        return $number1 + $number2;
    }

    /**
     * Calculate the difference between two numbers.
     *
     * @param float $number1 The first number.
     * @param float $number2 The second number.
     * @return float|int The difference between the two numbers.
     */
    public function subtract($number1, $number2) {
        if (!is_numeric($number1) || !is_numeric($number2)) {
            // Handle error: Invalid input
            throw new InvalidArgumentException('Both arguments must be numeric values.');
        }

        return $number1 - $number2;
    }

    /**
     * Calculate the product of two numbers.
     *
     * @param float $number1 The first number.
     * @param float $number2 The second number.
     * @return float|int The product of the two numbers.
     */
    public function multiply($number1, $number2) {
        if (!is_numeric($number1) || !is_numeric($number2)) {
            // Handle error: Invalid input
            throw new InvalidArgumentException('Both arguments must be numeric values.');
        }

        return $number1 * $number2;
    }

    /**
     * Calculate the quotient of two numbers.
     *
     * @param float $number1 The first number.
     * @param float $number2 The second number.
     * @return float|int The quotient of the two numbers.
     * @throws InvalidArgumentException If the second number is zero.
     */
    public function divide($number1, $number2) {
        if (!is_numeric($number1) || !is_numeric($number2)) {
            // Handle error: Invalid input
            throw new InvalidArgumentException('Both arguments must be numeric values.');
        }

        if ($number2 == 0) {
            // Handle error: Division by zero
            throw new InvalidArgumentException('Cannot divide by zero.');
        }

        return $number1 / $number2;
    }

    // Additional mathematical functions can be added here
}
