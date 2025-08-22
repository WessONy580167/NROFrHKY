<?php
// 代码生成时间: 2025-08-23 06:29:18
 * This class provides functionality to convert JSON data into a
 * more readable and formatted string.
 */
class JsonDataFormatter {

    /**
     * Converts a JSON string into a formatted string.
     *
     * @param string $json The JSON string to be formatted.
     * @param bool $assoc When true, returned objects will be converted into associative arrays.
     * @return mixed Formatted JSON string or an error message.
     */
    public function formatJsonString($json, $assoc = false) {
        try {
            // Decode the JSON string into a PHP variable
            $data = json_decode($json, $assoc);
            
            // Check for errors in decoding the JSON
            if (json_last_error() !== JSON_ERROR_NONE) {
                return 'Error decoding JSON: ' . json_last_error_msg();
            }
            
            // Encode the PHP variable back into a JSON string with formatting
            $formattedJson = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            
            // Check for errors in encoding the JSON
            if (json_last_error() !== JSON_ERROR_NONE) {
                return 'Error encoding JSON: ' . json_last_error_msg();
            }
            
            return $formattedJson;
        } catch (Exception $e) {
            // Catch any other exceptions and return an error message
            return 'An error occurred: ' . $e->getMessage();
        }
    }
}
