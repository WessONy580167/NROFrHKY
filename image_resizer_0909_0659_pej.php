<?php
// 代码生成时间: 2025-09-09 06:59:08
// 图片尺寸批量调整器
// image_resizer.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_resizer extends CI_Controller {

    // 构造函数
    public function __construct() {
        parent::__construct();
        // 加载模型和库
        $this->load->model('Image_model');
        $this->load->library('Image_lib');
    }

    // 显示批量调整图片尺寸的表单页面
    public function index() {
        // 检查用户是否已登录
        // 如果需要的话
        // $this->load->library('session');
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('login');
        // }

        // 加载视图
        $this->load->view('image_resizer_form');
    }

    // 处理批量调整图片尺寸的请求
    public function process() {
        // 获取上传的图片文件数组
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '2048';  // 2MB限制
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('image_resizer_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            
            // 调整图片尺寸
            $this->resize_images($data);
            
            // 重定向到结果页面
            redirect('image_resizer/result');
        }
    }

    // 调整图片尺寸
    private function resize_images($data) {
        // 设置图片尺寸调整配置
        $config['image_library'] = 'gd2';
        $config['source_image'] = $data['upload_data']['full_path'];
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 800;
        $config['height'] = 600;
        
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
    }

    // 显示调整后的图片
    public function result() {
        // 加载视图
        $this->load->view('image_resizer_result');
    }

}

/* End of file image_resizer.php */
/* Location: ./application/controllers/image_resizer.php */