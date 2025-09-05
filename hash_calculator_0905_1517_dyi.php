<?php
// 代码生成时间: 2025-09-05 15:17:19
 * This class provides a simple way to calculate hash values for strings.
 * It uses PHP's built-in hashing functions and handles errors.
 */
class HashCalculator {

    /**
     * Calculates the hash of a given string using the specified algorithm.
     *
     * @param string $string The string to be hashed.
     * @param string $algorithm The hash algorithm to use (e.g., 'md5', 'sha256').
     * @return string The hash value of the string.
     * @throws Exception If the algorithm is not supported.
     */
    public function calculateHash($string, $algorithm) {
        // Check if the algorithm is supported
        if (!in_array($algorithm, hash_algos(), true)) {
            throw new Exception("Unsupported hash algorithm: {$algorithm}.");
        }

        // Calculate the hash
        $hash = hash($algorithm, $string);

        return $hash;
    }
}
