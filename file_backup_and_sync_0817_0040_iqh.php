<?php
// 代码生成时间: 2025-08-17 00:40:13
// File: file_backup_and_sync.php
// Description: This script is designed to backup and sync files using PHP and CodeIgniter framework.

defined('BASEPATH') OR exit('No direct script access allowed');

class FileBackupAndSync extends CI_Controller {

    // Backup a single file
    public function backupFile($sourcePath, $destinationPath) {
        try {
            if (!file_exists($sourcePath)) {
                throw new Exception('Source file does not exist.');
            }

            if (!is_writable($destinationPath)) {
                throw new Exception('Destination path is not writable.');
            }

            if (!copy($sourcePath, $destinationPath)) {
                throw new Exception('Failed to copy file.');
            }

            log_message('info', 'The file has been successfully backed up.');

        } catch (Exception $e) {
            log_message('error', $e->getMessage());
        }
    }

    // Synchronize the files between two directories
    public function syncDirectories($sourceDir, $destinationDir) {
        try {
            if (!is_dir($sourceDir) || !is_dir($destinationDir)) {
                throw new Exception('Both source and destination must be directories.');
            }

            $sourceFiles = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($sourceDir),
                RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($sourceFiles as $file) {
                $destination = $destinationDir . DIRECTORY_SEPARATOR . $file->getRelativePathname();
                $parent = dirname($destination);
                if (!file_exists($parent)) {
                    mkdir($parent, 0777, true);
                }
                $this->backupFile($file->getPathname(), $destination);
            }

            log_message('info', 'Directories have been synchronized.');

        } catch (Exception $e) {
            log_message('error', $e->getMessage());
        }
    }

    // Example usage of backup and sync functions
    public function index() {
        // Set the source and destination paths
        $sourcePath = './source/file.txt';
        $destinationPath = './backup/file.txt';
        $sourceDir = './source/';
        $destinationDir = './backup/';

        // Backup a single file
        $this->backupFile($sourcePath, $destinationPath);

        // Synchronize directories
        $this->syncDirectories($sourceDir, $destinationDir);
    }
}
