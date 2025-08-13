<?php
// 代码生成时间: 2025-08-14 04:32:01
defined('BASEPATH') OR exit('No direct script access allowed');

class PreventSqlInjection extends CI_Controller {

    /**
     * 构造函数
     *
     * 加载数据库库
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 插入数据
     *
     * 使用查询构建器安全地插入数据
     */
    public function insertData() {
        // 假设这些数据是从用户输入获取的
        $data = [
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        ];

        try {
            // 使用查询构建器插入数据，防止SQL注入
            $this->db->insert('users', $data);
            $response = ['status' => 'success', 'message' => 'Data inserted successfully'];
        } catch (Exception $e) {
            // 错误处理
            $response = ['status' => 'error', 'message' => 'Error inserting data: ' . $e->getMessage()];
        }

        // 返回JSON响应
        echo json_encode($response);
    }

    /**
     * 查询数据
     *
     * 使用查询构建器安全地查询数据
     */
    public function queryData() {
        $username = $this->input->get('username');

        try {
            // 使用查询构建器查询数据，防止SQL注入
            $query = $this->db->get_where('users', ['username' => $username]);
            $response = ['status' => 'success', 'data' => $query->result_array()];
        } catch (Exception $e) {
            // 错误处理
            $response = ['status' => 'error', 'message' => 'Error querying data: ' . $e->getMessage()];
        }

        // 返回JSON响应
        echo json_encode($response);
    }
}
