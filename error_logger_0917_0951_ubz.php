<?php
// 代码生成时间: 2025-09-17 09:51:45
class Error_Logger {

    /**
     * @var string Path to the log file
     */
    private $logFilePath;

    /**
     * Constructor
     *
     * Initialize the log file path
     */
    public function __construct() {
        $this->logFilePath = APPPATH . 'logs/error_log.txt';
    }

    /**
     * Write error to log file
     *
     * @param string $message Error message
     * @param int    $level   Error level
     */
    public function logError($message, $level = 1) {
        try {
            // Get current time
            $time = date('Y-m-d H:i:s');

            // Create log message
            $logMessage = '[' . $time . '] - ' . $level . ': ' . $message . PHP_EOL;

            // Write to log file
            file_put_contents($this->logFilePath, $logMessage, FILE_APPEND);

        } catch (Exception $e) {
            // Handle any exceptions that occur during logging
            // In a real-world application, you might want to log this error or notify an admin
            echo 'Error logging error: ' . $e->getMessage();
        }
    }

    /**
     * Log a simple error message
     *
     * @param string $message Error message
     */
    public function simpleError($message) {
        $this->logError($message, 1);
    }

    /**
     * Log a warning
     *
     * @param string $message Warning message
     */
    public function warning($message) {
        $this->logError($message, 2);
    }

    /**
     * Log a notice
     *
     * @param string $message Notice message
     */
    public function notice($message) {
        $this->logError($message, 3);
    }

    /**
     * Log an info message
     *
     * @param string $message Info message
     */
    public function info($message) {
        $this->logError($message, 4);
    }
}
