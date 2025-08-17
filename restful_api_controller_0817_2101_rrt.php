<?php
// 代码生成时间: 2025-08-17 21:01:21
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class RestfulApiController extends REST_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        // Load the model
        $this->load->model('api_model');
    }

    /**
     * Get all data
     *
     * @return void
     */
    public function index_get() {
        try {
            // Retrieve data from the model
            $data = $this->api_model->get_all_data();
            // Check if data is not empty
            if (!empty($data)) {
                // Set the response
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                // Set the response if data is empty
                $this->response(['message' => 'No data found'], REST_Controller::HTTP_NOT_FOUND);
            }
        } catch (Exception $e) {
            // Handle errors and return a message
            $this->response(['message' => 'Failed to load data: ' . $e->getMessage()], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Insert a new data
     *
     * @return void
     */
    public function index_post() {
        // Check if the post data is set
        if (!$this->post()) {
            $this->response(['message' => 'Invalid data provided'], REST_Controller::HTTP_BAD_REQUEST);
        }
        try {
            // Insert data into the database
            $insert_id = $this->api_model->insert_data($this->post());
            if ($insert_id) {
                // Set the response for successful insert
                $this->response(['message' => 'Data added successfully'], REST_Controller::HTTP_CREATED);
            } else {
                // Set the response if insert fails
                $this->response(['message' => 'Failed to add data'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            // Handle errors and return a message
            $this->response(['message' => 'Failed to add data: ' . $e->getMessage()], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update existing data
     *
     * @param int $id
     * @return void
     */
    public function index_put($id) {
        // Check if the data is provided
        if (!$this->put()) {
            $this->response(['message' => 'Invalid data provided'], REST_Controller::HTTP_BAD_REQUEST);
        }
        try {
            // Update the data in the database
            $update = $this->api_model->update_data($id, $this->put());
            if ($update) {
                // Set the response for successful update
                $this->response(['message' => 'Data updated successfully'], REST_Controller::HTTP_OK);
            } else {
                // Set the response if update fails
                $this->response(['message' => 'Failed to update data'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            // Handle errors and return a message
            $this->response(['message' => 'Failed to update data: ' . $e->getMessage()], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete data
     *
     * @param int $id
     * @return void
     */
    public function index_delete($id) {
        try {
            // Delete the data from the database
            $delete = $this->api_model->delete_data($id);
            if ($delete) {
                // Set the response for successful delete
                $this->response(['message' => 'Data deleted successfully'], REST_Controller::HTTP_OK);
            } else {
                // Set the response if delete fails
                $this->response(['message' => 'Failed to delete data'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            // Handle errors and return a message
            $this->response(['message' => 'Failed to delete data: ' . $e->getMessage()], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
