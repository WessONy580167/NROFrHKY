<?php
// 代码生成时间: 2025-08-21 15:34:02
// 应用CodeIgniter框架的核心库
defined('BASEPATH') OR exit('No direct script access allowed');

class ThemeSwitcher extends CI_Controller {

    // 构造函数
    public function __construct() {
        parent::__construct();
        // 加载模板库和会话库
        $this->load->library('template');
        $this->load->library('session');
    }

    // 主题切换函数
    public function switch_theme($theme = NULL) {
        if (!$theme) {
            // 如果没有提供主题，则重定向回首页
            redirect(base_url());
        } else {
            // 检查主题是否有效
            $valid_themes = array('light', 'dark');
            if (in_array($theme, $valid_themes)) {
                // 设置会话变量来保存主题选择
                $this->session->set_userdata('theme', $theme);
                // 重定向回首页以应用新主题
                redirect(base_url());
            } else {
                // 如果无效，显示错误消息
                $this->template->show_message('Invalid theme selected.', 'error');
            }
        }
    }

    // 显示消息函数
    private function show_message($message, $type) {
        // 显示消息并设置类型（错误或警告）
        $data['message'] = $message;
        $data['type'] = $type;
        $this->template->load('default', 'message', $data);
    }

}

// 定义模板库
class Template {
    private $CI;
    private $themes = array('light' => 'light_theme', 'dark' => 'dark_theme');

    public function __construct() {
        $this->CI =& get_instance();
    }

    // 加载视图函数
    public function load($theme, $view, $data = NULL) {
        // 应用主题
        $this->apply_theme($theme);
        // 加载视图文件
        $this->CI->load->view($this->themes[$theme].'/'.$view, $data);
    }

    // 应用主题函数
    private function apply_theme($theme) {
        // 设置CSS文件路径和标题
        $this->CI->data['css_file'] = $this->themes[$theme].'/'.$theme.'.css';
        $this->CI->data['page_title'] = 'Theme Switcher - '. ucfirst($theme);
    }

    // 显示消息函数
    public function show_message($message, $type) {
        // 加载消息视图
        $this->load('default', 'message', array('message' => $message, 'type' => $type));
    }
}
