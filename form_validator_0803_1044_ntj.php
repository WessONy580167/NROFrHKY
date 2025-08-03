<?php
// 代码生成时间: 2025-08-03 10:44:56
// 文件路径：application/core/FormValidator.php
// 描述：FormValidator 类实现了表单数据验证功能
class FormValidator extends CI_Controller {

    // 构造函数
    public function __construct() {
        parent::__construct();
        // 加载CI框架的表单验证库
        $this->load->library('form_validation');
    }

    // 设置验证规则
    private function set_rules() {
        // 验证规则数组
        $config = [
            ['field' => 'username', 'label' => 'Username', 'rules' => 'required|trim|alpha_numeric|min_length[5]|max_length[12]'],
            ['field' => 'email', 'label' => 'Email', 'rules' => 'required|trim|valid_email'],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'required|trim|min_length[8]|max_length[20]'],
            // 添加更多字段验证规则
        ];
        // 设置验证规则
        $this->form_validation->set_rules($config);
    }

    // 验证表单数据
    public function validate() {
        // 设置验证规则
        $this->set_rules();
        // 执行验证
        if ($this->form_validation->run() == FALSE) {
            // 验证失败，返回错误信息
            $errors = validation_errors();
            return json_encode(['success' => false, 'errors' => $errors]);
        } else {
            // 验证成功，返回成功信息
            return json_encode(['success' => true, 'message' => 'Form data is valid']);
        }
    }
}
