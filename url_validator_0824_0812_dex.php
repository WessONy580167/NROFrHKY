<?php
// 代码生成时间: 2025-08-24 08:12:21
class UrlValidator {

    protected $CI;

    public function __construct() {
        // Get CI instance
        $this->CI =& get_instance();
    }

    /**
     * Validate URL
     *
     * @param string $url The URL to validate
     * @return boolean Returns TRUE if the URL is valid, FALSE otherwise
     */
    public function validate($url) {
        // Use cURL to check if the URL is reachable
        $ch = curl_init($url);

        // Set cURL options to not return the transfer
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        curl_exec($ch);

        // Get the HTTP response code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Check if the URL is valid based on the HTTP response code
        if ($httpCode >= 200 && $httpCode < 400) {
            return true;
        } else {
            return false;
        }
    }
}

// Usage example
/**
 * Usage of UrlValidator class
 */
$urlValidator = new UrlValidator();
$url = 'http://example.com';
$isValid = $urlValidator->validate($url);

if ($isValid) {
    echo 'URL is valid';
} else {
    echo 'URL is invalid';
}
