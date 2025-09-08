<?php
// 代码生成时间: 2025-09-08 17:10:21
 * It is designed to be easily understandable and maintainable.
 */
class MathTool {

    /**
     * Adds two numbers.
     *
     * @param float $a The first number.
     * @param float $b The second number.
     * @return float The sum of the two numbers.
     */
    public function add($a, $b) {
        return $a + $b;
    }

    /**
     * Subtracts the second number from the first.
     *
     * @param float $a The first number.
     * @param float $b The second number.
     * @return float The difference between the two numbers.
     */
    public function subtract($a, $b) {
        return $a - $b;
    }

    /**
     * Multiplies two numbers.
     *
     * @param float $a The first number.
     * @param float $b The second number.
     * @return float The product of the two numbers.
     */
    public function multiply($a, $b) {
        return $a * $b;
    }

    /**
     * Divides the first number by the second.
     *
     * @param float $a The first number.
     * @param float $b The second number.
     * @return float The quotient of the two numbers.
     * @throws Exception if division by zero is attempted.
     */
    public function divide($a, $b) {
        if ($b == 0) {
            throw new Exception('Division by zero is not allowed.');
        }
        return $a / $b;
    }

    /**
     * Calculates the power of a number.
     *
     * @param float $base The base number.
     * @param float $exponent The exponent.
     * @return float The result of the base raised to the power of the exponent.
     */
    public function power($base, $exponent) {
        return pow($base, $exponent);
    }

    /**
     * Calculates the square root of a number.
     *
     * @param float $number The number to find the square root of.
     * @return float The square root of the number.
     * @throws Exception if the number is negative.
     */
    public function sqrt($number) {
        if ($number < 0) {
            throw new Exception('Square root of a negative number is not real.');
        }
        return sqrt($number);
    }
}
