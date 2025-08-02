<?php
// 代码生成时间: 2025-08-02 19:02:01
class Migration_tool extends CI_Controller {

    /**
     * Constructor
     *
     * Load the necessary libraries and helpers.
     */
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database library
        $this->load->library('migration'); // Load CodeIgniter's migration library
    }

    /**
     * Run Migrations
     *
     * Apply all pending migrations to the database.
     */
    public function run_migrations() {
        if ($this->migration->current()) {
            // Migration successful
            echo json_encode(['status' => 'success', 'message' => 'Migrations applied successfully.']);
        } else {
            // Error handling
            show_error($this->migration->error_string());
        }
    }

    /**
     * Rollback Migrations
     *
     * Revert the last batch of migrations.
     */
    public function rollback_migrations() {
        if ($this->migration->version(0)) {
            // Migration rollback successful
            echo json_encode(['status' => 'success', 'message' => 'Migrations rolled back successfully.']);
        } else {
            // Error handling
            show_error($this->migration->error_string());
        }
    }

    /**
     * Latest Migration
     *
     * Apply the latest migration.
     */
    public function latest_migration() {
        if ($this->migration->latest()) {
            // Migration successful
            echo json_encode(['status' => 'success', 'message' => 'Latest migration applied successfully.']);
        } else {
            // Error handling
            show_error($this->migration->error_string());
        }
    }
}
