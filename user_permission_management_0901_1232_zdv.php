<?php
// 代码生成时间: 2025-09-01 12:32:24
// 引入CodeIgniter框架
defined('BASEPATH') OR exit('No direct script access allowed');

// UserPermissionManagement控制器
class UserPermissionManagement extends CI_Controller {

    // 构造函数
    public function __construct() {
        parent::__construct();
        // 加载模型
        $this->load->model('UserPermissionModel');
    }

    // 显示用户权限列表
    public function index() {
        // 获取所有用户权限
        $data['permissions'] = $this->UserPermissionModel->getAllPermissions();

        // 加载视图
        $this->load->view('user_permission/index', $data);
    }

    // 添加用户权限
    public function addPermission() {
        // 验证表单提交
        $this->form_validation->set_rules('permission_name', 'Permission Name', 'required');
        $this->form_validation->set_rules('permission_description', 'Description', 'required');

        // 检查表单是否有效
        if ($this->form_validation->run() === FALSE) {
            // 验证失败，加载视图
            $this->load->view('user_permission/add');
        } else {
            // 验证成功，添加权限
            $permission_data = array(
                'name' => $this->input->post('permission_name'),
                'description' => $this->input->post('permission_description')
            );

            // 插入数据到数据库
            if ($this->UserPermissionModel->addPermission($permission_data)) {
                // 添加成功，重定向到列表页面
                redirect('user_permission_management');
            } else {
                // 添加失败，显示错误信息
                $this->session->set_flashdata('error', 'Failed to add permission.');
                redirect('user_permission_management/add_permission');
            }
        }
    }

    // 用户权限模型
    class UserPermissionModel extends CI_Model {

        // 获取所有用户权限
        public function getAllPermissions() {
            $query = $this->db->get('permissions');
            return $query->result();
        }

        // 添加权限
        public function addPermission($permission_data) {
            $this->db->insert('permissions', $permission_data);
            return $this->db->affected_rows();
        }
    }
}
