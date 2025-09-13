<?php
// 代码生成时间: 2025-09-13 23:00:45
class FormValidator extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load the form validation library
        $this->load->library('form_validation');
    }
    
    public function index() {
        // Define form validation rules
        $config = [
            ['field' => 'username', 'label' => 'Username', 'rules' => 'required|alpha_numeric'],
            ['field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'required|min_length[8]'],
        ];
        
        // Apply the form validation rules
        foreach ($config as $rule) {
            $this->form_validation->set_rules($rule['field'], $rule['label'], $rule['rules']);
        }
        
        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            $errors = validation_errors();
            $this->output->set_content_type('application/json')->set_output(json_encode(['error' => $errors]));
        } else {
            // Validation passed
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => 'Form data is valid']));
        }
    }
}
