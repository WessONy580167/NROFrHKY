<?php
// 代码生成时间: 2025-08-11 18:04:33
class FolderOrganizer {

    /**
     * Constructor
     */
    public function __construct() {
        // Load CI Loader and helper
        $this->ci =& get_instance();
        $this->ci->load->helper('directory');
    }

    /**
     * Organize a folder
     *
     * @param string $sourcePath The path of the folder to organize
     * @return bool
     */
    public function organize($sourcePath) {
        // Check if the directory exists
        if (!is_dir($sourcePath)) {
            log_message('error', 'The directory does not exist: ' . $sourcePath);
            return false;
        }

        // Get directory contents
        $files = directory_map($sourcePath, 1);

        // Organize files
        foreach ($files as $file => $path) {
            $fileSegments = explode('/', $file);
            $lastSegment = array_pop($fileSegments);

            // Create a new directory for the file if needed
            if ($fileSegments) {
                $newPath = implode('/', $fileSegments) . '/' . $lastSegment;
                $newDirPath = dirname($newPath);
                if (!is_dir($newDirPath)) {
                    mkdir($newDirPath, 0755, true);
                }
            } else {
                $newPath = $lastSegment;
            }

            // Move the file to the new path
            if (!rename($sourcePath . '/' . $file, $sourcePath . '/' . $newPath)) {
                log_message('error', 'Failed to move file: ' . $file);
                return false;
            }
        }

        // Return success
        return true;
    }
}

// Example usage:
// $organizer = new FolderOrganizer();
// $result = $organizer->organize('/path/to/your/folder');
// if ($result) {
//     echo 'Folder organized successfully.';
// } else {
//     echo 'Failed to organize folder.';
// }