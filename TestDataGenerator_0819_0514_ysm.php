<?php
// 代码生成时间: 2025-08-19 05:14:25
class TestDataGenerator {

    /**
     * Generates a random string.
     * 
     * @param int $length The length of the string to generate.
     * @return string
     */
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Generates a random integer within a specified range.
     * 
     * @param int $min The minimum value of the range.
     * @param int $max The maximum value of the range.
     * @return int
     */
    public function generateRandomInt($min = 1, $max = 100) {
        return rand($min, $max);
    }

    /**
     * Generates a random float number.
     * 
     * @param float $min The minimum value of the range.
     * @param float $max The maximum value of the range.
     * @param int $precision The precision of the float number.
     * @return float
     */
    public function generateRandomFloat($min = 1.0, $max = 100.0, $precision = 1) {
        return round($min + mt_rand() / mt_getrandmax() * ($max - $min), $precision);
    }

    /**
     * Generates a random date within a specified range.
     * 
     * @param string $startDate The start date in 'Y-m-d' format.
     * @param string $endDate The end date in 'Y-m-d' format.
     * @return string
     */
    public function generateRandomDate($startDate = '1970-01-01', $endDate = '2023-12-31') {
        $timestamp = rand(strtotime($startDate), strtotime($endDate));
        return date('Y-m-d', $timestamp);
    }

    /**
     * Generates a random email address.
     * 
     * @return string
     */
    public function generateRandomEmail() {
        $domain = $this->generateRandomString(8) . '.com';
        return $this->generateRandomString(8) . '@' . $domain;
    }

    /**
     * Generates a random user name.
     * 
     * @return string
     */
    public function generateRandomUsername() {
        return $this->generateRandomString(8);
    }

    /**
     * Generates a random password.
     * 
     * @return string
     */
    public function generateRandomPassword() {
        return $this->generateRandomString(12);
    }

}
