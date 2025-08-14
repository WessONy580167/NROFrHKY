<?php
// 代码生成时间: 2025-08-15 02:50:49
defined('BASEPATH') OR exit('No direct script access allowed');

class PasswordEncryptionDecryption extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        // Load the encryption library
        $this->load->library('encryption');
    }

    /**
     * Encrypt a password
     *
     * @param string $password The plain text password to be encrypted
     * @return string
     */
    public function encrypt($password) {
        // Check if the password is empty
        if (empty($password)) {
            // Return an error message
            return json_encode(array(
                'status' => 'error',
                'message' => 'Password cannot be empty'
            ));
        }

        // Encrypt the password
        $encrypted_password = $this->encryption->encrypt($password);

        // Return the encrypted password
        return json_encode(array(
            'status' => 'success',
            'encrypted_password' => $encrypted_password
        ));
    }

    /**
     * Decrypt a password
     *
     * @param string $encrypted_password The encrypted password to be decrypted
     * @return string
     */
    public function decrypt($encrypted_password) {
        // Check if the encrypted password is empty
        if (empty($encrypted_password)) {
            // Return an error message
            return json_encode(array(
                'status' => 'error',
                'message' => 'Encrypted password cannot be empty'
            ));
        }

        try {
            // Decrypt the password
            $decrypted_password = $this->encryption->decrypt($encrypted_password);
            // If decryption fails, return an error message
            if ($decrypted_password === FALSE) {
                return json_encode(array(
                    'status' => 'error',
                    'message' => 'Decryption failed'
                ));
            }

            // Return the decrypted password
            return json_encode(array(
                'status' => 'success',
                'decrypted_password' => $decrypted_password
            ));
        } catch (Exception $e) {
            // Return an error message if an exception occurs
            return json_encode(array(
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ));
        }
    }
}
