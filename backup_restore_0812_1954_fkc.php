<?php
// 代码生成时间: 2025-08-12 19:54:50
class BackupRestoreService {

    /**
     * @var string The path where backups are stored.
     */
    private $backupPath;

    /**
     * @var CI_Loader The CodeIgniter loader instance.
     */
    private $loader;

    /**
     * Constructor
     *
     * @param string $backupPath The path where backups should be stored.
     * @param CI_Loader $loader The CodeIgniter loader instance.
     */
    public function __construct($backupPath, CI_Loader $loader) {
        $this->backupPath = $backupPath;
        $this->loader = $loader;
    }

    /**
     * Backup the database.
     *
     * @return bool True on success, false on failure.
     */
    public function backupDatabase() {
        try {
            // Load the database library
            $this->loader->database();
            $db = $this->loader->db;

            // Check if the backup path is writable
            if (!is_writable($this->backupPath)) {
                throw new Exception('The backup path is not writable.');
            }

            // Generate the backup filename
            $backupFilename = 'backup_' . date('YmdHis') . '.sql';
            $backupFilePath = $this->backupPath . '/' . $backupFilename;

            // Backup the database
            $db->save_queries = FALSE; // Disable query log
            $backupContent = '';
            $mysqli = $db->conn_id;

            // Get all tables
            $tables = $db->list_tables();
            foreach ($tables as $table) {
                // Create the SQL statement to backup the table
                $result = $mysqli->query('SELECT * FROM `' . $table . '`;');
                $num_fields = $result->field_count;
                $res = $mysqli->query('SHOW CREATE TABLE `' . $table . '`;');
                $row2 = $res->fetch_row();
                $backupContent .= $row2[1] . ';

';
                $res->free_result();
                while ($row = $result->fetch_row()) {
                    $backupContent .= 'INSERT INTO `' . $table . '` VALUES( ';
                    for ($j = 0; $j < $num_fields; $j++) {
                        $backupContent .= '