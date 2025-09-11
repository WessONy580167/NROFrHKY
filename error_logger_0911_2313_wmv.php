<?php
// 代码生成时间: 2025-09-11 23:13:59
class ErrorLogger {

    /**
     * Log an error message to a file.
     *
     * @param string $message The error message to log.
     * @param string $level The error level (e.g., 'error', 'warning', 'info').
     */
    public function logError($message, $level = 'error') {
        // Define the log file path
        $logFilePath = APPPATH . 'logs/error_log.txt';

        // Get the current timestamp
        $time = date('Y-m-d H:i:s');

        // Format the log message
        $logMessage = '[' . $time . '] [' . strtoupper($level) . '] ' . $message . PHP_EOL;

        // Check if the log file is writable
        if (!is_writable($logFilePath)) {
            // Handle the error if the log file is not writable
            // For example, you can try to create the file or directory, or log the error elsewhere
            throw new Exception('Log file is not writable: ' . $logFilePath);
        }

        // Write the log message to the file
        file_put_contents($logFilePath, $logMessage, FILE_APPEND);
    }

    /**
     * Handle an exception and log the error.
     *
     * @param Exception $exception The exception to handle.
     */
    public function handleException(Exception $exception) {
        // Get the error message and code from the exception
        $message = $exception->getMessage();
        $code = $exception->getCode();

        // Log the error message with the 'error' level
        $this->logError($message, 'error');
    }
}
