<?php
// 代码生成时间: 2025-08-03 16:55:33
class Backup_restore extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the database utility library
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
    }

    /**
     * Performs a database backup.
     *
     * @return void
     */
    public function backup() {
        try {
            // Backup the database
            $prefs = array(
                'format' => 'zip',
                'filename' => 'db_backup.sql'
            );
            $backup = $this->dbutil->backup($prefs);
            
            // Save the backup file to the server
            $save_path = './downloads/db_backup.zip';
            write_file($save_path, $backup);
            
            // Offer the backup file for download
            force_download($save_path, NULL);
            
        } catch (Exception $e) {
            // Handle errors here
            log_message('error', 'Database backup failed: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Database backup failed. Please try again.');
            redirect('backup_restore/backup');
        }
    }

    /**
     * Restores the database from a backup file.
     *
     * @return void
     */
    public function restore() {
        try {
            // Check if a file was uploaded
            if (!$this->input->post('userfile')) {
                throw new Exception('No file uploaded.');
            }
            
            // Load the uploaded file
            $file_path = $_FILES['userfile']['tmp_name'];
            
            // Restore the database from the file
            $restore = $this->dbutil->restore($file_path);
            
            if ($restore !== TRUE) {
                throw new Exception('Database restore failed.');
            }
            
            // Set a success message
            $this->session->set_flashdata('success', 'Database restored successfully.');
            redirect('backup_restore/restore');
        } catch (Exception $e) {
            // Handle errors here
            log_message('error', 'Database restore failed: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Database restore failed. Please try again.');
            redirect('backup_restore/restore');
        }
    }
}
