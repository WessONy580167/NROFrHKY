<?php
// 代码生成时间: 2025-09-04 06:37:24
class FormValidator {

    /**
     * Reference to the CodeIgniter instance.
     * @var CI_Controller
     */
    private $ci;

    /**
     * Constructor.
     * Assigns the CodeIgniter instance to a private variable.
     */
    public function __construct() {
        $this->ci =& get_instance();
    }

    /**
     * Validate form data.
     * @param array $rules Array of validation rules.
     * @return bool|array Returns true if validation passes, or an array of errors if it fails.
     */
    public function validate($rules) {
        // Run the validation process
        $isValid = $this->ci->form_validation->run($rules);

        // Check if validation failed
        if (!$isValid) {
            // Return the error messages
            return array(
                'status' => 'error',
                'errors' => $this->ci->form_validation->error_array()
            );
        }

        // Validation passed
        return true;
    }

    /**
     * Set custom validation rules.
     * @param array $rules Array of custom validation rules.
     */
    public function set_rules($rules) {
        // Set the custom rules
        foreach ($rules as $field => $params) {
            $this->ci->form_validation->set_rules($field, $params[0], $params[1]);
        }
    }
}
