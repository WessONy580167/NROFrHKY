<?php
// 代码生成时间: 2025-08-17 07:32:46
class Backup_restore extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->load->library('zip');
        $this->load->database();
    }

    /**
     * Function to backup database
     *
     * @return void
     */
    public function backup_database() {
        try {
            // Get database configuration
            $db_config = $this->db->get_config();
            $hostname = $db_config['hostname'];
            $username = $db_config['username'];
            $password = $db_config['password'];
            $database = $db_config['database'];

            // Create a filename for the backup
            $filename = 'backup_' . date('YmdHis') . '.sql';

            // Run the backup command
            $command = "mysqldump -h {$hostname} -u {$username} -p{$password} {$database} > /path/to/backup/{$filename}";

            // Execute the command
            exec($command);

            // Check if the backup file exists
            if (file_exists('/path/to/backup/' . $filename)) {
                // Create a zip archive of the backup file
                $this->zip->add_dir('/path/to/backup/');
                $this->zip->archive('/path/to/backup/backup.zip');

                // Download the backup zip file
                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename=