<?php
// 代码生成时间: 2025-09-29 00:02:03
class FileUncompressTool {

    private $source_file;
    private $destination_folder;
    private $file_type;

    /**
     * Constructor
     *
     * @param string $source_file Path to the compressed file.
     * @param string $destination_folder Path to the destination folder.
     * @param string $file_type Type of the compressed file (e.g., 'zip', 'tar', 'gz').
     */
    public function __construct($source_file, $destination_folder, $file_type) {
        $this->source_file = $source_file;
        $this->destination_folder = $destination_folder;
        $this->file_type = $file_type;
    }

    /**
     * Uncompress the file
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function uncompress() {
        try {
            if (!file_exists($this->source_file)) {
                throw new Exception('Source file does not exist.');
            }

            if (!is_dir($this->destination_folder)) {
                mkdir($this->destination_folder, 0777, true);
            }

            switch ($this->file_type) {
                case 'zip':
                    return $this->unzip();
                case 'tar':
                    return $this->untar();
                case 'gz':
                    return $this->ungz();
                default:
                    throw new Exception('Unsupported file type.');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    /**
     * Unzip the compressed file
     *
     * @return bool
     */
    private function unzip() {
        return unzip($this->source_file, $this->destination_folder);
    }

    /**
     * Untar the compressed file
     *
     * @return bool
     */
    private function untar() {
        return tar($this->destination_folder, $this->source_file);
    }

    /**
     * Ungzip the compressed file
     *
     * @return bool
     */
    private function ungz() {
        return gzopen($this->source_file, 'r') && copy('compress.zlib://' . $this->source_file, $this->destination_folder . '/' . basename($this->source_file, '.gz'));
    }
}

// Usage example
// $uncompress_tool = new FileUncompressTool('/path/to/file.zip', '/path/to/destination', 'zip');
// if ($uncompress_tool->uncompress()) {
//     echo 'File uncompressed successfully.';
// } else {
//     echo 'Failed to uncompress the file.';
// }
