<?php
// 代码生成时间: 2025-08-28 07:36:05
class PreventSqlInjection extends CI_Controller {

    /**
     * 构造函数
     * 加载数据库库
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 获取用户数据
     * 使用查询构造器防止SQL注入
     * @param string $user_id 用户ID
     * @return void
     */
    public function getUserData($user_id) {
        try {
            // 使用查询构造器来防止SQL注入
            $query = $this->db->get_where('users', ['id' => $user_id]);
            $result = $query->row_array();

            if (!empty($result)) {
                // 数据存在，返回结果
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($result));
            } else {
                // 数据不存在，返回错误信息
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['error' => 'User not found']));
            }
        } catch (Exception $e) {
            // 错误处理
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => $e->getMessage()]));
        }
    }
}
