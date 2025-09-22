<?php
// 代码生成时间: 2025-09-23 05:08:14
 * It includes error handling and comment documentation for ease of maintenance and expansion.
 */
class ApiFormatter {

    /**
     * Format a successful API response
     *
     * @param array $data Data to be included in the response
     * @param string $message Optional message to include in the response
     * @return array Formatted API response
     */
    public function success($data = [], $message = '') {
        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
        return $response;
    }

    /**
     * Format an error API response
     *
     * @param string $message The error message
     * @param int $code The error code
     * @param array $data Optional additional data to include
     * @return array Formatted API error response
     */
    public function error($message, $code = 400, $data = []) {
        $response = [
            'status' => 'error',
            'message' => $message,
            'code' => $code,
            'data' => $data
        ];
        return $response;
    }
}
