<?php
// 代码生成时间: 2025-09-09 16:58:36
class PreventSqlInjection extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        // Load any models, libraries, etc.
    }

    /**
     * Example function to demonstrate SQL injection prevention
     * @param string $username
     */
    public function index($username = NULL) {
        try {
            // Use Query Binding to prevent SQL injection
            $query = $this->db->select('*')
                ->from('users')
                ->where('username', $this->db->escape_str($username))
                ->get();

            if ($query->num_rows() > 0) {
                $data['user'] = $query->row_array();
            } else {
                $data['user'] = NULL;
            }

            $this->load->view('prevent_sql_injection_view', $data);
        } catch (Exception $e) {
            // Handle exceptions
            log_message('error', 'Database error: ' . $e->getMessage());
            show_error('A database error occurred. Please try again later.', 500, 'Database Error');
        }
    }

}

/* End of file prevent_sql_injection.php */
/* Location: ./application/controllers/prevent_sql_injection.php */