<?php
// 代码生成时间: 2025-08-26 22:34:51
class NetworkConnectionChecker {

    /**
     * Check if a URL is reachable.
     *
     * @param string $url The URL to check.
     * @return bool Returns true if the URL is reachable, false otherwise.
     */
    public function isUrlReachable($url) {
        try {
            // Initialize a cURL session
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_NOBODY, true); // We don't need the body contents
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects

            // Execute the cURL session and get the response
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // Close the cURL session
            curl_close($ch);

            // Check if the URL is reachable based on HTTP response code
            return ($response !== false && $httpCode >= 200 && $httpCode < 300);
        } catch (Exception $e) {
            // Log the error and return false
            log_message('error', 'Network connection check failed: ' . $e->getMessage());
            return false;
        }
    }
}
