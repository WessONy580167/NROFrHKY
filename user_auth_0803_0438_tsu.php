<?php
// 代码生成时间: 2025-08-03 04:38:31
class User_auth extends CI_Controller {

    /**
     * Constructor
     *
     * Initialize the CodeIgniter session and load necessary libraries.
     */
    public function __construct() {
        parent::__construct();
        // Load the Session library to handle user sessions
        $this->load->library('session');
        // Load the Form Validation library to validate user input
        $this->load->library('form_validation');
        // Load the User_Model to interact with the database
        $this->load->model('User_model');
    }

    /**
     * Login method
     *
     * Handles the user login process.
     */
    public function login() {
        // Check if the form is submitted
        if ($this->input->post()) {
            // Define validation rules
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            // Run validation
            if ($this->form_validation->run() === FALSE) {
                // Validation failed, return to login page with error
                $this->session->set_flashdata('error', 'Invalid email or password.');
                redirect('login_page');
            } else {
                // Validation passed, proceed with login
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                // Call the User_Model to verify credentials
                if ($this->User_model->verify_user($email, $password)) {
                    // Set user session data
                    $this->session->set_userdata('user_id', $this->User_model->get_user_id($email));
                    $this->session->set_flashdata('success', 'Logged in successfully.');
                    redirect('user_dashboard');
                } else {
                    // Authentication failed
                    $this->session->set_flashdata('error', 'Invalid email or password.');
                    redirect('login_page');
                }
            }
        }
    }

    /**
     * Logout method
     *
     * Handles user logout by destroying the session.
     */
    public function logout() {
        // Destroy the user session
        $this->session->sess_destroy();
        // Redirect to login page after logout
        redirect('login_page');
    }
}

/**
 * User_Model
 *
 * This model handles database operations for user authentication.
 */
class User_model extends CI_Model {

    /**
     * Verify user credentials
     *
     * @param string $email User email
     * @param string $password User password
     * @return bool Returns true if credentials are valid, false otherwise.
     */
    public function verify_user($email, $password) {
        // Query the database to find the user with the given email
        $query = $this->db->get_where('users', array('email' => $email));
        $user = $query->row();

        if ($user) {
            // Verify the password by comparing it with the hash stored in the database
            return password_verify($password, $user->password);
        }

        return false;
    }

    /**
     * Get user ID
     *
     * @param string $email User email
     * @return mixed Returns user ID if found, null otherwise.
     */
    public function get_user_id($email) {
        // Query the database to find the user with the given email
        $query = $this->db->get_where('users', array('email' => $email));
        $user = $query->row();

        if ($user) {
            return $user->id;
        }

        return null;
    }
}
