<?php
// 代码生成时间: 2025-08-11 00:06:56
class Inventory_management extends CI_Controller {

    // 构造函数
    public function __construct() {
        parent::__construct();
        // 加载数据库
        $this->load->database();
        // 加载库存模型
        $this->load->model('inventory_model');
    }

    // 显示库存列表
    public function index() {
        // 获取库存数据
        $data['inventory'] = $this->inventory_model->get_inventory();
        // 加载视图
        $this->load->view('inventory/index', $data);
    }

    // 添加库存
    public function add() {
        // 验证表单数据
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            // 验证失败，加载表单视图
            $this->load->view('inventory/add');
        } else {
            // 验证通过，添加库存
            if ($this->inventory_model->add_inventory($this->input->post())) {
                // 添加成功，重定向到库存列表
                redirect('inventory');
            } else {
                // 添加失败，显示错误消息
                $this->session->set_flashdata('error', 'Failed to add inventory.');
                redirect('inventory/add');
            }
        }
    }

    // 编辑库存
    public function edit($id) {
        // 获取库存数据
        $data['inventory'] = $this->inventory_model->get_inventory_by_id($id);
        // 验证表单数据
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            // 验证失败，加载编辑视图
            $this->load->view('inventory/edit', $data);
        } else {
            // 验证通过，更新库存
            if ($this->inventory_model->update_inventory($id, $this->input->post())) {
                // 更新成功，重定向到库存列表
                redirect('inventory');
            } else {
                // 更新失败，显示错误消息
                $this->session->set_flashdata('error', 'Failed to update inventory.');
                redirect('inventory/edit/' . $id);
            }
        }
    }

    // 删除库存
    public function delete($id) {
        // 删除库存
        if ($this->inventory_model->delete_inventory($id)) {
            // 删除成功，重定向到库存列表
            redirect('inventory');
        } else {
            // 删除失败，显示错误消息
            $this->session->set_flashdata('error', 'Failed to delete inventory.');
            redirect('inventory');
        }
    }
}
