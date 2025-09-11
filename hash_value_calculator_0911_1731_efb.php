<?php
// 代码生成时间: 2025-09-11 17:31:28
class HashValueCalculator extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        // Load necessary libraries and helpers
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    /**
     * Index method to display the hash value calculation form
     */
    public function index() {
        // Load the view
        $this->load->view('hash_value_calculator_view');
    }

    /**
     * Calculate hash value for the given input
     */
    public function calculate() {
        // Set validation rules
        $this->form_validation->set_rules('input', 'Input', 'required');

        // Validate the input
        if ($this->form_validation->run() == FALSE) {
            // Redirect to index with error message
            $this->session->set_flashdata('error', 'Please enter the input value.');
            redirect('hash_value_calculator');
        } else {
            // Get the input value
            $input = $this->input->post('input');

            // Calculate the hash value
            $hashValue = hash('sha256', $input);

            // Display the result
            $data['input'] = $input;
            $data['hashValue'] = $hashValue;
            $this->load->view('hash_value_result_view', $data);
        }
    }
}

/*
 * Helper functions can be added here for reusable code
 *
 * function generateHash($input) {
 *     return hash('sha256', $input);
 * }
 */