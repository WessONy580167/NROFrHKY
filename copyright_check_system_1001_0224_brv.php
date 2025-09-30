<?php
// 代码生成时间: 2025-10-01 02:24:24
class CopyrightCheckSystem extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('copyright_model');
        $this->load->library('form_validation');
    }

    /**
     * Index Page for this controller.
     */
    public function index() {
        // Load the view for the copyright check system
        $this->load->view('copyright_check_view');
    }
    
    /**
     * Process the submitted content for copyright infringement check.
     *
     * @return void
     */
    public function check() {
        // Set validation rules
        $this->form_validation->set_rules('content', 'Content', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            $this->load->view('copyright_check_view');
        } else {
            // Validation passed, proceed with the check
            $content = $this->input->post('content');
            $is_infringement = $this->copyright_model->check_infringement($content);
            
            if ($is_infringement) {
                // Handle infringement
                $this->display_infringement_result();
            } else {
                // Handle non-infringement
                $this->display_non_infringement_result();
            }
        }
    }
    
    /**
     * Display the result of a copyright infringement check.
     *
     * @return void
     */
    private function display_infringement_result() {
        $data['message'] = 'Copyright infringement detected!';
        $this->load->view('copyright_result_view', $data);
    }
    
    /**
     * Display the result of a non-infringement check.
     *
     * @return void
     */
    private function display_non_infringement_result() {
        $data['message'] = 'No copyright infringement detected.';
        $this->load->view('copyright_result_view', $data);
    }
}

/* End of file CopyrightCheckSystem.php */
/* Location: ./application/controllers/CopyrightCheckSystem.php */