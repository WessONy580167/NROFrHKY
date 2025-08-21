<?php
// 代码生成时间: 2025-08-22 02:07:31
class Inventory extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Inventory_model'); // Load the Inventory Model
    }

    /**
     * Index Page for this controller.
     */
    public function index() {
        $data['title'] = 'Inventory Management';
        $data['inventory'] = $this->Inventory_model->get_all_items();
        $this->load->view('inventory_view', $data);
    }

    /**
     * Add a new inventory item
     */
    public function add_item() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'quantity',
                'label' => 'Quantity',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required|numeric'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('add_item_view');
        } else {
            $this->Inventory_model->add_item();
            redirect('inventory');
        }
    }

    /**
     * Edit an existing inventory item
     */
    public function edit_item($id) {
        if ($this->Inventory_model->item_exists($id)) {
            $data['item'] = $this->Inventory_model->get_item($id);
            $this->load->view('edit_item_view', $data);
        } else {
            show_error('The item you are trying to edit does not exist.');
        }
    }

    /**
     * Update an existing inventory item
     */
    public function update_item($id) {
        if ($this->Inventory_model->item_exists($id)) {
            $this->Inventory_model->update_item($id);
            redirect('inventory');
        } else {
            show_404();
        }
    }

    /**
     * Delete an inventory item
     */
    public function delete_item($id) {
        if ($this->Inventory_model->item_exists($id)) {
            $this->Inventory_model->delete_item($id);
            redirect('inventory');
        } else {
            show_404();
        }
    }
}

/* End of file Inventory.php */
/* Location: ./application/controllers/Inventory.php */