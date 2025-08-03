<?php
// 代码生成时间: 2025-08-04 06:56:02
defined('BASEPATH') OR exit('No direct script access allowed');

// Load the REST_Controller library
require APPPATH . 'libraries/REST_Controller.php';

class ApiExample extends REST_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models
        $this->load->model('api_model');
    }

    // Get method example
    public function users_get() {
        // Fetch users from the model
        $users = $this->api_model->get_users();
        if ($users) {
            $this->response(
                [
                    'status' => TRUE,
                    'message' => 'Users retrieved successfully.',
                    'data' => $users
                ],
                200
            );
        } else {
            $this->response(
                [
                    'status' => FALSE,
                    'message' => 'No users were found.'
                ],
                404
            );
        }
    }

    // Post method example
    public function users_post() {
        // Validate input
        $this->validate_input();
        
        $id = $this->api_model->insert_user($this->post());
        
        if ($id) {
            $this->response(
                [
                    'status' => TRUE,
                    'message' => 'User created successfully.',
                    'id' => $id
                ],
                201
            );
        } else {
            $this->response(
                [
                    'status' => FALSE,
                    'message' => 'Failed to create user.'
                ],
                500
            );
        }
    }

    // Put method example
    public function users_put($id) {
        // Validate input
        $this->validate_input();
        
        $update = $this->api_model->update_user($id, $this->put());
        
        if ($update) {
            $this->response(
                [
                    'status' => TRUE,
                    'message' => 'User updated successfully.',
                    'id' => $id
                ],
                200
            );
        } else {
            $this->response(
                [
                    'status' => FALSE,
                    'message' => 'Failed to update user.'
                ],
                500
            );
        }
    }

    // Delete method example
    public function users_delete($id) {
        $delete = $this->api_model->delete_user($id);
        
        if ($delete) {
            $this->response(
                [
                    'status' => TRUE,
                    'message' => 'User deleted successfully.',
                    'id' => $id
                ],
                200
            );
        } else {
            $this->response(
                [
                    'status' => FALSE,
                    'message' => 'Failed to delete user.'
                ],
                500
            );
        }
    }

    private function validate_input() {
        $this->form_validation->set_data($this->post());
        
        $this->form_validation->set_rules(
            'name', 'Name', 'required',
            ['required' => 'You must provide a name.']
        );
        
        if ($this->form_validation->run() === FALSE) {
            $this->response(
                [
                    'status' => FALSE,
                    'message' => validation_errors()
                ],
                400
            );
        }
    }
}
