<?php
// 代码生成时间: 2025-09-16 03:02:54
class PasswordTool {

    private $key; // Encryption key

    /**
     * Constructor
     *
     * Initializes the encryption key
     */
    public function __construct() {
        // Define the encryption key
        $this->key = config_item('encryption_key');
    }

    /**
     * Encrypt a password
     *
     * @param string $password The plain text password to encrypt
     * @return string The encrypted password
     */
    public function encrypt_password($password) {
        try {
            // Use OpenSSL to encrypt the password
            $encrypted = openssl_encrypt($password, 'AES-256-CBC', $this->key, 0, $this->get_iv());

            // Base64 encode the encrypted password for safe storage
            return base64_encode($encrypted);
        } catch (Exception $e) {
            // Handle encryption errors
            log_message('error', 'Encryption failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Decrypt a password
     *
     * @param string $encrypted_password The encrypted password to decrypt
     * @return string The decrypted password
     */
    public function decrypt_password($encrypted_password) {
        try {
            // Base64 decode the encrypted password
            $encrypted = base64_decode($encrypted_password);

            // Use OpenSSL to decrypt the password
            $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', $this->key, 0, $this->get_iv());

            return $decrypted;
        } catch (Exception $e) {
            // Handle decryption errors
            log_message('error', 'Decryption failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get the initialization vector for encryption
     *
     * @return string The initialization vector
     */
    private function get_iv() {
        // Define the initialization vector
        $iv_length = openssl_cipher_iv_length('AES-256-CBC');
        return openssl_random_pseudo_bytes($iv_length);
    }
}

// Example usage:
$password_tool = new PasswordTool();
$plain_password = 'your_plaintext_password';
$encrypted_password = $password_tool->encrypt_password($plain_password);
$decrypted_password = $password_tool->decrypt_password($encrypted_password);

echo 'Encrypted Password: ' . $encrypted_password . "
";
echo 'Decrypted Password: ' . $decrypted_password . "
";