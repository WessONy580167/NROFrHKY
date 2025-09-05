<?php
// 代码生成时间: 2025-09-05 23:17:57
// CodeIgniter Inventory Management System
// Filename: Inventory.php
// Description: Handles inventory management operations.

class Inventory extends CI_Controller {

    // Constructor
    public function __construct() {
        parent::__construct();
        $this->load->model('Inventory_model'); // Load the Inventory model
    }

    // Function to display the inventory list
    public function index() {
        $data['inventories'] = $this->Inventory_model->get_all_inventories(); // Load all inventory items
        $this->load->view('inventory/index', $data); // Load the inventory view
    }

    // Function to add a new inventory item
    public function add() {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Item Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'quantity',
                'label' => 'Quantity',
                'rules' => 'required|numeric'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('inventory/add'); // Load the add inventory view if validation fails
        } else {
            $this->Inventory_model->insert_inventory(); // Insert the new inventory item
            redirect('inventory/index'); // Redirect to the inventory list
        }
    }

    // Function to edit an existing inventory item
    public function edit($id) {
        $data['inventory'] = $this->Inventory_model->get_inventory_by_id($id); // Load the specific inventory item
        $this->load->view('inventory/edit', $data); // Load the edit inventory view
    }

    // Function to update an existing inventory item
    public function update() {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Item Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'quantity',
                'label' => 'Quantity',
                'rules' => 'required|numeric'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id')); // Load the edit view if validation fails
        } else {
            $this->Inventory_model->update_inventory(); // Update the inventory item
            redirect('inventory/index'); // Redirect to the inventory list
        }
    }

    // Function to delete an inventory item
    public function delete($id) {
        $this->Inventory_model->delete_inventory($id); // Delete the inventory item
        redirect('inventory/index'); // Redirect to the inventory list
    }

}

// Inventory Model
class Inventory_model extends CI_Model {

    // Function to get all inventory items
    public function get_all_inventories() {
        $query = $this->db->get('inventory'); // Select all from the inventory table
        return $query->result(); // Return the result as an object array
    }

    // Function to insert a new inventory item
    public function insert_inventory() {
        $data = array(
            'name' => $this->input->post('name'),
            'quantity' => $this->input->post('quantity')
        );
        $this->db->insert('inventory', $data); // Insert the new inventory item
    }

    // Function to get an inventory item by ID
    public function get_inventory_by_id($id) {
        $query = $this->db->get_where('inventory', array('id' => $id)); // Select from the inventory table where id is the given id
        return $query->row(); // Return the result as an object
    }

    // Function to update an existing inventory item
    public function update_inventory() {
        $data = array(
            'name' => $this->input->post('name'),
            'quantity' => $this->input->post('quantity')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('inventory', $data); // Update the inventory item
    }

    // Function to delete an inventory item
    public function delete_inventory($id) {
        $this->db->where('id', $id);
        $this->db->delete('inventory'); // Delete the inventory item
    }

}
