<?php
// 代码生成时间: 2025-08-31 17:09:14
class ZipExtractor {

    private $ci;
    private $zipPath;
    private $extractPath;

    /**
     * Constructor
     *
     * @param string $zipPath Path to the zip file.
     * @param string $extractPath Path to extract the zip contents to.
     */
    public function __construct($zipPath, $extractPath) {
        // Get the CodeIgniter super-object
        $this->ci =& get_instance();

        // Set the zip and extract paths
        $this->zipPath = $zipPath;
        $this->extractPath = $extractPath;
    }

    /**
     * Extract zip file
     *
     * @return boolean True on success, false on failure.
     */
    public function extract() {
        try {
            // Check if the zip file exists
            if (!file_exists($this->zipPath)) {
                throw new Exception('Zip file not found.');
            }

            // Check if the extract directory is writable
            if (!is_writable($this->extractPath)) {
                throw new Exception('Extract directory is not writable.');
            }

            // Create a new ZipArchive object
            $zip = new ZipArchive();

            // Open the zip file
            if ($zip->open($this->zipPath) === TRUE) {
                // Extract the contents to the specified directory
                $zip->extractTo($this->extractPath);
                $zip->close();
                return true;
            } else {
                throw new Exception('Failed to open zip file.');
            }
        } catch (Exception $e) {
            // Log the error
            log_message('error', $e->getMessage());
            return false;
        }
    }
}

// Example usage
$zipPath = 'path_to_your_zip_file.zip';
$extractPath = 'path_to_extract_directory';

$zipExtractor = new ZipExtractor($zipPath, $extractPath);
if ($zipExtractor->extract()) {
    echo 'Zip file extracted successfully.';
} else {
    echo 'Failed to extract zip file.';
}

?>