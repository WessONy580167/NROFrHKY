<?php
// 代码生成时间: 2025-08-18 13:36:23
class PasswordTool {

    /**
     * Encrypts a password using PHP's password_hash function.
     *
     * @param string $password The password to encrypt.
     * @return string The encrypted password or FALSE on failure.
     */
    public function encryptPassword($password) {
        // Use PASSWORD_DEFAULT to use the current default algorithm
        // For example, PASSWORD_DEFAULT can be bcrypt, or Argon2i
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the password was successfully hashed
        if ($hashedPassword) {
            return $hashedPassword;
        } else {
            // Handle error
            throw new Exception('Password encryption failed.');
        }
    }

    /**
     * Decrypts a password using PHP's password_verify function.
     *
     * @param string $password The original password to verify.
     * @param string $hashedPassword The encrypted password to check against.
     * @return bool TRUE if the password is correct, FALSE otherwise.
     */
    public function decryptPassword($password, $hashedPassword) {
        // Use password_verify to check if the password matches the hash
        if (password_verify($password, $hashedPassword)) {
            return true;
        } else {
            return false;
        }
    }
}

// Example usage:
try {
    $passwordTool = new PasswordTool();
    $originalPassword = 'your_password_here';
    $encryptedPassword = $passwordTool->encryptPassword($originalPassword);
    if ($encryptedPassword) {
        echo "Encrypted Password: $encryptedPassword
";

        // Now let's try to decrypt it
        $isPasswordCorrect = $passwordTool->decryptPassword($originalPassword, $encryptedPassword);
        if ($isPasswordCorrect) {
            echo "Password is correct!
";
        } else {
            echo "Password is incorrect.
";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
