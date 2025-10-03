<?php
// 代码生成时间: 2025-10-04 04:00:56
defined('BASEPATH') OR exit('No direct script access allowed');

class UserPermissionManagement extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the necessary models and helpers
        $this->load->model('UserPermissionModel');
        $this->load->library('session');
        // Check for user authentication
        $this->checkAuthentication();
    }

    /**
     * Check if the user is authenticated.
     * If not, redirect to the login page.
     *
     * @return void
     */
    private function checkAuthentication() {
        if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
        }
    }

    /**
     * Display the user permissions page.
     *
     * @return void
     */
    public function index() {
        // Retrieve all user permissions from the database
        $data['permissions'] = $this->UserPermissionModel->getAllPermissions();
        // Load the view with the permissions data
        $this->load->view('user_permissions', $data);
    }

    /**
     * Assign a permission to a user.
     *
     * @param int $userId User's ID
     * @param int $permissionId Permission's ID
     * @return void
     */
    public function assignPermission($userId, $permissionId) {
        try {
            if ($this->UserPermissionModel->assignPermission($userId, $permissionId)) {
                $this->session->set_flashdata('message', 'Permission assigned successfully.');
                redirect('UserPermissionManagement');
            } else {
                $this->session->set_flashdata('error', 'Failed to assign permission.');
                redirect('UserPermissionManagement');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            $this->session->set_flashdata('error', 'An error occurred while assigning permission.');
            redirect('UserPermissionManagement');
        }
    }

    /**
     * Remove a permission from a user.
     *
     * @param int $userId User's ID
     * @param int $permissionId Permission's ID
     * @return void
     */
    public function removePermission($userId, $permissionId) {
        try {
            if ($this->UserPermissionModel->removePermission($userId, $permissionId)) {
                $this->session->set_flashdata('message', 'Permission removed successfully.');
                redirect('UserPermissionManagement');
            } else {
                $this->session->set_flashdata('error', 'Failed to remove permission.');
                redirect('UserPermissionManagement');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            $this->session->set_flashdata('error', 'An error occurred while removing permission.');
            redirect('UserPermissionManagement');
        }
    }
}

/* End of file UserPermissionManagement.php */
/* Location: ./application/controllers/UserPermissionManagement.php */