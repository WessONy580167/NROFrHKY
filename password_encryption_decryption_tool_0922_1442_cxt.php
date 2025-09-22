<?php
// 代码生成时间: 2025-09-22 14:42:49
class Password_Encryption_Decryption_Tool {

    /**
     * Encrypts a given password using PHP's built-in password hashing functions.
     *
     * @param string $password The password to be encrypted.
     * @return string The encrypted password or an error message.
     */
    public function encryptPassword($password) {
        try {
            // Use PASSWORD_DEFAULT for a strong, secure hash
            $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
            return $encryptedPassword;
        } catch (Exception $e) {
            // Handle potential errors during encryption
            return "Error encrypting password: " . $e->getMessage();
        }
    }

    /**
     * Decrypts a given password hash to verify the original password.
     *
     * @param string $password The original password to verify.
     * @param string $hash The encrypted password hash.
     * @return bool True if the password matches the hash, false otherwise.
     */
    public function decryptPassword($password, $hash) {
        try {
            // Use password_verify to check if the password matches the hash
            if (password_verify($password, $hash)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Handle potential errors during decryption
            return "Error decrypting password: " . $e->getMessage();
        }
    }
}
