<?php
// 代码生成时间: 2025-08-15 09:22:39
class ErrorLogger {

    protected $log_directory;
    protected $log_file;

    /**
     * Constructor
     *
     * @param   array   $config   Configuration array
     */
    public function __construct($config = array()) {
        // Set the log directory and file based on the config
        $this->log_directory = $config['log_directory'] ?? APPPATH . 'logs/';
        $this->log_file = $config['log_file'] ?? 'error_log.txt';
    }

    /**
     * Log an error
     *
     * @param   string  $message   The error message to log
     * @param   int     $level     The error level (optional)
     */
    public function logError($message, $level = 1) {
        try {
            // Ensure the log directory exists and is writable
            if (!is_dir($this->log_directory) || !is_writable($this->log_directory)) {
                throw new Exception('Log directory is not writable.');
            }

            // Create the log file path
            $log_file_path = $this->log_directory . $this->log_file;

            // Get the current date and time for the log entry
            $date = date('Y-m-d H:i:s');

            // Format the log entry
            $log_entry = '[' . $date . '] - ' . $level . ' - ' . $message . PHP_EOL;

            // Write the log entry to the file
            file_put_contents($log_file_path, $log_entry, FILE_APPEND);

        } catch (Exception $e) {
            // Handle any errors that occur during logging
            error_log('Error logging error: ' . $e->getMessage());
        }
    }

    /**
     * Get the log file path
     *
     * @return  string  The path to the log file
     */
    public function getLogFilePath() {
        return $this->log_directory . $this->log_file;
    }
}
