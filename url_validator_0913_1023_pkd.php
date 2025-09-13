<?php
// 代码生成时间: 2025-09-13 10:23:08
class URLValidator {

    /**
     * Validate a URL
     *
     * @param string $url The URL to validate
     * @return bool Returns true if the URL is valid, false otherwise
     */
    public function validate($url) {
        // Check if the URL is a string
        if (!is_string($url)) {
            // Log error or handle it as needed
            return false;
        }

        // Use filter_var to check if the URL is valid
        // FILTER_VALIDATE_URL checks if the given string is a valid URL
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        } else {
            // Log error or handle it as needed
            return false;
        }
    }

    /**
     * Check if a URL is reachable
     *
     * @param string $url The URL to check
     * @return bool Returns true if the URL is reachable, false otherwise
     */
    public function isReachable($url) {
        // Initialize a cURL session
        $ch = curl_init($url);

        // Set options for cURL
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set a timeout of 10 seconds

        // Execute the cURL session
        curl_exec($ch);

        // Get the HTTP response code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Close the cURL session
        curl_close($ch);

        // Check if the HTTP response code is in the 200-299 range
        if ($httpCode >= 200 && $httpCode < 300) {
            return true;
        } else {
            return false;
        }
    }
}

// Example usage
$urlValidator = new URLValidator();
$url = "https://www.example.com";

if ($urlValidator->validate($url)) {
    if ($urlValidator->isReachable($url)) {
        echo "The URL is valid and reachable.
";
    } else {
        echo "The URL is valid but not reachable.
";
    }
} else {
    echo "The URL is not valid.
";
}
