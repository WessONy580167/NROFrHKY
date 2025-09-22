<?php
// 代码生成时间: 2025-09-23 01:07:48
class User_authentication extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the necessary libraries and helpers
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('user_model');
    }

    /**
     * Login page view
     */
    public function login() {
        // Check if user is already logged in
        if ($this->session->userdata('is_logged_in')) {
            redirect('dashboard');
        }
        // Load the login view
        $this->load->view('login_view');
    }

    /**
     * Process the login form
     */
    public function process_login() {
        // Set validation rules
        $config = [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim'
            ]
        ];
        // Load the validation rules
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() === FALSE) {
            // If validation fails, load the login view
            $this->login();
        } else {
            // Validate credentials
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->user_model->validate_user($username, $password);

            if ($user) {
                // Create session data
                $session_data = [
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'is_logged_in' => true
                ];
                $this->session->set_userdata($session_data);
                redirect('dashboard');
            } else {
                // Set error message
                $this->session->set_flashdata('login_error', 'Invalid username or password');
                redirect('login');
            }
        }
    }

    /**
     * User dashboard
     */
    public function dashboard() {
        // Check if user is logged in
        if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
        }
        // Load the dashboard view
        $this->load->view('dashboard_view');
    }

    /**
     * Logout user
     */
    public function logout() {
        // Destroy the session data
        $this->session->sess_destroy();
        redirect('login');
    }
}

/**
 * User Model
 *
 * This model handles user-related data and operations.
 */
class User_model extends CI_Model {

    public function validate_user($username, $password) {
        // Hash the password for security
        $hash = md5($password);
        // Check if user exists and password matches
        $query = $this->db->get_where('users', ['username' => $username, 'password' => $hash]);
        if ($query->num_rows() === 1) {
            return $query->row();
        }
        return false;
    }
}

// Load the database configuration
$config['hostname'] = 'localhost';
$config['username'] = 'root';
$config['password'] = '';
$config['database'] = 'codeigniter_db';
$config['dbdriver'] = 'mysqli';
$config['dbprefix'] = '';
$config['pconnect'] = false;
$config['db_debug'] = (ENVIRONMENT !== 'production');
$config['cache_on'] = false;
$config['cachedir'] = '';
$config['char_set'] = 'utf8';
$config['dbcollat'] = 'utf8_general_ci';
\$db = \$this->load->database($config);
