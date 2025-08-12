<?php
// 代码生成时间: 2025-08-13 03:37:18
class User_Authentication extends CI_Controller {

    /**
     * Constructor
     *
     * Loads the necessary libraries and helpers
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('User_model');
    }

    /**
     * Login method
     *
     * Authenticates the user based on the provided credentials.
     *
     * @return void
     */
    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $data['error'] = 'Invalid credentials';
            $this->load->view('login_view', $data);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->User_model->get_user_by_email($email);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $this->session->set_userdata('user_id', $user['id']);
                    redirect('dashboard');
                } else {
                    $data['error'] = 'Invalid password';
                    $this->load->view('login_view', $data);
                }
            } else {
                $data['error'] = 'User not found';
                $this->load->view('login_view', $data);
            }
        }
    }

    /**
     * Logout method
     *
     * Destroys the session and redirects to the login page.
     *
     * @return void
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    /**
     * Password hashing method
     *
     * Hashes the password using PHP's password_hash function.
     *
     * @param string $password The plain text password
     * @return string The hashed password
     */
    private function hash_password($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
