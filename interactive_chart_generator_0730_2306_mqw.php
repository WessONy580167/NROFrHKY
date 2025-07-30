<?php
// 代码生成时间: 2025-07-30 23:06:17
class InteractiveChart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the model for chart data
        $this->load->model('chart_model');
    }

    /**
     * Default method to load the interactive chart view
     */
    public function index() {
        // Check for any errors
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Process the form data and generate chart
            $data = $this->input->post();
            $chart_data = $this->chart_model->get_chart_data($data);
            if (empty($chart_data)) {
                // Handle error if no chart data is available
                $this->session->set_flashdata('error', 'No data available to generate chart.');
                redirect('interactive_chart');
            } else {
                // Pass chart data to view
                $this->load->view('interactive_chart_view', ['chart_data' => $chart_data]);
            }
        } else {
            // Load the interactive chart form
            $this->load->view('interactive_chart_view');
        }
    }

    /**
     * AJAX method to handle chart data fetching
     */
    public function fetch_chart_data() {
        // Check if AJAX request is made
        if ($this->input->is_ajax_request()) {
            // Get the data from the database
            $data = $this->input->post();
            $chart_data = $this->chart_model->get_chart_data($data);
            
            // Return JSON-encoded chart data
            echo json_encode(['chart_data' => $chart_data]);
        } else {
            // Handle non-AJAX request error
            show_404();
        }
    }
}

class ChartModel extends CI_Model {

    protected $table = 'charts';

    public function get_chart_data($data) {
        // Validate and sanitize the input data
        $data = $this->security->xss_clean($data);
        
        // Query the database to get chart data based on the input
        $query = $this->db->get_where($this->table, $data);
        
        // Return the query result
        return $query->result_array();
    }
}

/* End of file InteractiveChart.php */
/* Location: ./application/controllers/InteractiveChart.php */