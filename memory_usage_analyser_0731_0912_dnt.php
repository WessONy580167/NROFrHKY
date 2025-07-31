<?php
// 代码生成时间: 2025-07-31 09:12:47
class MemoryUsageAnalyser {

    /**
     * Logs memory usage at different points in the application.
     *
     * @param string $stage The stage of the application at which the memory is being checked.
     * @param string $file The file where the memory usage will be logged.
     * @return void
     */
    public function logMemoryUsage($stage, $file) {
        // Check if the file is writable
        if (!is_writable($file)) {
            log_message('error', "Memory usage cannot be logged to $file. File is not writable.");
            return;
        }

        // Get memory usage
        $memoryUsage = memory_get_usage(true);

        // Format memory usage for better readability
        $formattedMemoryUsage = $this->formatMemory($memoryUsage);

        // Log memory usage
        $logMessage = "Memory usage at $stage: $formattedMemoryUsage";
        log_message('info', $logMessage);

        // Write to file
        file_put_contents($file, $logMessage . "
", FILE_APPEND);
    }

    /**
     * Formats memory usage into a more readable format (B, KB, MB, GB).
     *
     * @param int $bytes The memory usage in bytes.
     * @return string The formatted memory usage.
     */
    private function formatMemory($bytes) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = pow(1024, $pow);
        $bytes /= $pow;

        return round($bytes, 2) . ' ' . $units[$pow - 1024];
    }
}

// Usage example:
// $analyser = new MemoryUsageAnalyser();
// $analyser->logMemoryUsage('Startup', 'memory_log.txt');
