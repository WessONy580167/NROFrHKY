<?php
// 代码生成时间: 2025-10-04 23:29:23
class QuizSystem extends CI_Controller {

    /**
# 增强安全性
     * 构造函数
# 扩展功能模块
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('QuizModel');
    }

    /**
     * 显示题库列表
     */
    public function index() {
        $data['quizzes'] = $this->QuizModel->get_all_quizzes();
# 改进用户体验
        $this->load->view('quiz_list', $data);
# 改进用户体验
    }

    /**
     * 添加新题目
     */
    public function add_quiz() {
        $this->load->library('form_validation');
        if ($this->form_validation->run('quiz_rules')) {
            $this->QuizModel->add_quiz();
            $this->session->set_flashdata('message', '新题目添加成功');
            redirect('quiz_system');
# 添加错误处理
        } else {
            $this->load->view('add_quiz');
# 扩展功能模块
        }
    }

    /**
     * 编辑题目
     */
    public function edit_quiz($id) {
        $this->load->library('form_validation');
        if ($this->form_validation->run('quiz_rules')) {
            $this->QuizModel->update_quiz($id);
            $this->session->set_flashdata('message', '题目更新成功');
            redirect('quiz_system');
        } else {
            $data['quiz'] = $this->QuizModel->get_quiz_by_id($id);
            $this->load->view('edit_quiz', $data);
        }
    }

    /**
     * 删除题目
     */
    public function delete_quiz($id) {
        $this->QuizModel->delete_quiz($id);
        $this->session->set_flashdata('message', '题目删除成功');
        redirect('quiz_system');
    }
}

/* End of file QuizSystem.php */
/* Location: ./application/controllers/QuizSystem.php */