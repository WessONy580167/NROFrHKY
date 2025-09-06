<?php
// 代码生成时间: 2025-09-06 18:07:58
class TestDataGenerator extends CI_Controller {

    /**
     * Constructor.
     * Initializes the CodeIgniter object.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('TestDataModel');
    }

    /**
     * Generate test data.
     *
     * @param int $numRecords Number of records to generate.
     * @return void
     */
    public function generate($numRecords = 10) {
        try {
            // Validate the number of records to generate
            if (!is_numeric($numRecords) || $numRecords < 1) {
                throw new Exception('Invalid number of records specified.');
            }

            // Generate test data
            for ($i = 0; $i < $numRecords; $i++) {
                $data = [
                    'name' => 'Test User ' . ($i + 1),
                    'email' => 'test' . $i . '@example.com',
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $this->TestDataModel->insert($data);
            }

            // Display a success message
            $this->session->set_flashdata('message', 'Test data generated successfully.');
            redirect('test_data');

        } catch (Exception $e) {
            // Handle errors
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('test_data');
        }
    }

    /**
     * Display test data.
     *
     * @return void
     */
    public function index() {
        $data['testData'] = $this->TestDataModel->get_all();
        $this->load->view('test_data_view', $data);
    }
}

/**
 * TestDataModel: A model class to interact with the test data table.
 *
 * @author Your Name
 * @version 1.0
 */
class TestDataModel extends CI_Model {

    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Insert a new record into the test data table.
     *
     * @param array $data Data to insert.
     * @return void
     */
    public function insert($data) {
        $this->db->insert('test_data', $data);
    }

    /**
     * Get all records from the test data table.
     *
     * @return array
     */
    public function get_all() {
        $query = $this->db->get('test_data');
        return $query->result_array();
    }
}
