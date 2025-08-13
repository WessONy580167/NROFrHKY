<?php
// 代码生成时间: 2025-08-13 16:55:36
// 批量文件重命名工具
// batch_rename_tool.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch_rename_tool extends CI_Controller {

    /**
# 添加错误处理
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        // 加载必要的库和助手
        $this->load->library('form_validation');
        $this->load->helper('file');
# 增强安全性
    }

    /**
     * 显示批量文件重命名表单
# TODO: 优化性能
     */
# 扩展功能模块
    public function index() {
        $data = array();
        // 页面数据
# 优化算法效率
        $data['title'] = '批量文件重命名工具';
        
        // 加载视图
# NOTE: 重要实现细节
        $this->load->view('batch_rename_form', $data);
    }

    /**
     * 处理批量文件重命名请求
# NOTE: 重要实现细节
     */
# 优化算法效率
    public function rename_files() {
        // 设置验证规则
        $config = array(
            array(
                'field' => 'source_folder',
                'label' => '源文件夹',
# 增强安全性
                'rules' => 'required'
            ),
            array(
                'field' => 'target_folder',
                'label' => '目标文件夹',
                'rules' => 'required'
            )
        );
        
        // 运行验证
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            // 验证失败，重定向回表单页面
            redirect('batch_rename_tool');
        } else {
            // 获取表单数据
            $source_folder = $this->input->post('source_folder');
            $target_folder = $this->input->post('target_folder');
            $prefix = $this->input->post('prefix');
            
            try {
                // 读取源文件夹中的文件
                $files = scandir($source_folder);
                
                foreach ($files as $file) {
                    // 跳过目录和隐藏文件
                    if ($file !== '.' && $file !== '..' && !is_dir($source_folder . '/' . $file)) {
                        // 获取文件扩展名
                        $ext = pathinfo($file, PATHINFO_EXTENSION);
                        
                        // 构建目标文件名
                        $new_name = $target_folder . '/' . $prefix . '_' . $file;
# 扩展功能模块
                        
                        // 重命名文件
# 改进用户体验
                        if (rename($source_folder . '/' . $file, $new_name)) {
                            echo '文件 ' . $file . ' 重命名为 ' . basename($new_name, '.' . $ext) . '.' . $ext . '
';
                        } else {
                            // 处理重命名错误
                            echo '无法重命名文件 ' . $file . '
';
                        }
                    }
                }
# 增强安全性
            } catch (Exception $e) {
                // 处理异常
                echo '发生错误: ' . $e->getMessage();
            }
        }
# TODO: 优化性能
    }
}

/*
 * 辅助函数：批量重命名表单视图
 */
function batch_rename_form() {
# FIXME: 处理边界情况
    echo '<h1>批量文件重命名工具</h1>';
    echo '<form method="post" action="' . base_url('batch_rename_tool(rename_files)') . '">';
# NOTE: 重要实现细节
    echo '源文件夹: <input type="text" name="source_folder" required><br>';
    echo '目标文件夹: <input type="text" name="target_folder" required><br>';
    echo '前缀: <input type="text" name="prefix"><br>';
    echo '<input type="submit" value="重命名文件">';
    echo '</form>';
}
