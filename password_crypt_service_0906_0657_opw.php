<?php
// 代码生成时间: 2025-09-06 06:57:26
class PasswordCryptService {

    /**
     * Encrypts a password using PHP's password_hash function.
     *
     * @param string $password The password to encrypt.
     * @return string|bool The encrypted password or false on failure.
     */
    public function encryptPassword($password) {
        if (empty($password)) {
            // Throw an exception if the password is empty.
            throw new InvalidArgumentException('Password cannot be empty.');
        }

        // Use PASSWORD_DEFAULT for better compatibility and security.
        $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($encryptedPassword === false) {
            // Handle encryption failure.
            throw new RuntimeException('Password encryption failed.');
        }

        return $encryptedPassword;
    }

    /**
     * Decrypts a password using PHP's password_verify function.
     *
     * @param string $password The password to verify.
     * @param string $hash The hash to compare against.
     * @return bool True if the password matches the hash, false otherwise.
     */
    public function verifyPassword($password, $hash) {
        if (empty($password) || empty($hash)) {
            // Throw an exception if the password or hash is empty.
            throw new InvalidArgumentException('Password and hash cannot be empty.');
        }

        // Use password_verify to check if the password matches the hash.
        $isValid = password_verify($password, $hash);

        if ($isValid === false) {
            // Handle verification failure.
            throw new RuntimeException('Password verification failed.');
        }

        return $isValid;
    }
}
