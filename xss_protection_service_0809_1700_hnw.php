<?php
// 代码生成时间: 2025-08-09 17:00:26
class XssProtectionService {

    /**
     * @var CI_Input
     */
    private $input;

    /**
     * Constructor for XssProtectionService.
     *
     * @param CI_Input $input
     */
    public function __construct(CI_Input $input) {
        // Assign the CodeIgniter input instance to a property.
        $this->input = $input;
    }

    /**
     * Cleans the input to prevent XSS attacks.
     *
     * @param mixed $inputData The input data to be cleaned.
     * @return mixed The cleaned input data.
     */
    public function cleanInput($inputData) {
        try {
            // Use the native xss_clean function provided by CodeIgniter.
            $cleanedData = $this->input->xss_clean($inputData);

            // If cleaning is successful, return the cleaned data.
            return $cleanedData;
        } catch (Exception $ex) {
            // Handle any errors that occur during the cleaning process.
            log_message('error', 'XSS cleaning failed: ' . $ex->getMessage());
            return null;
        }
    }

    /**
     * Escapes HTML entities to prevent XSS attacks.
     *
     * @param string $data The string to escape.
     * @return string The escaped string.
     */
    public function escapeHtml($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}
