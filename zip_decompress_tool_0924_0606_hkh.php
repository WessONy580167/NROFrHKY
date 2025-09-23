<?php
// 代码生成时间: 2025-09-24 06:06:04
class ZipDecompressTool extends CI_Controller {

    private $zipFile;
    private $extractTo;

    /**
     * Constructor
     *
     * @param string $zipFile   Path to the zip file
     * @param string $extractTo Directory to extract the zip file
     */
    public function __construct($zipFile, $extractTo) {
        parent::__construct();
        $this->zipFile = $zipFile;
        $this->extractTo = $extractTo;
    }

    /**
     * Decompress the zip file
     *
     * @return bool True on success, false on failure
     */
    public function decompress() {
        try {
            if (!file_exists($this->zipFile)) {
                throw new Exception('Zip file does not exist.');
            }

            if (!is_writable($this->extractTo)) {
                throw new Exception('Extract directory is not writable.');
            }

            if (!class_exists('ZipArchive')) {
                throw new Exception('ZipArchive class not found.');
            }

            $zip = new ZipArchive();

            if ($zip->open($this->zipFile) === TRUE) {
                $zip->extractTo($this->extractTo);
                $zip->close();
                return true;
            } else {
                throw new Exception('Failed to open zip file.');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }
}
