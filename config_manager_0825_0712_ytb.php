<?php
// 代码生成时间: 2025-08-25 07:12:57
class Config_Manager {

    /**
     * @var CI_Controller Reference to the CodeIgniter controller.
     */
    private $CI;

    /**
     * Constructor
     */
    public function __construct() {
        // Get the CodeIgniter super-object
        $this->CI =& get_instance();
    }

    /**
     * Load a configuration file
     *
     * @param string $file The name of the configuration file.
     * @return bool True on success, false on failure.
     */
    public function load($file) {
        try {
            // Check if the file exists
            if (!file_exists($file)) {
                throw new Exception('Configuration file not found.');
            }

            // Load the configuration file
            $config = $this->CI->config->load($file, true);
            if ($config === false) {
                throw new Exception('Failed to load configuration file.');
            }
            return true;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    /**
     * Save configuration settings to a file
     *
     * @param string $file The name of the configuration file.
     * @param array $settings The configuration settings to save.
     * @return bool True on success, false on failure.
     */
    public function save($file, $settings) {
        try {
            // Write the configuration settings to the file
            if (!is_array($settings)) {
                throw new Exception('Invalid configuration settings.');
            }

            $config_content = "<?php
";
            foreach ($settings as $key => $value) {
                $config_content .= "$key = '$value';
";
            }
            $config_content .= '?>';

            if (!file_put_contents($file, $config_content)) {
                throw new Exception('Failed to save configuration file.');
            }
            return true;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    /**
     * Update a specific configuration setting
     *
     * @param string $file The name of the configuration file.
     * @param string $key The key of the setting to update.
     * @param mixed $value The new value of the setting.
     * @return bool True on success, false on failure.
     */
    public function update($file, $key, $value) {
        try {
            // Check if the file exists
            if (!file_exists($file)) {
                throw new Exception('Configuration file not found.');
            }

            // Read the current configuration settings
            $current_settings = require($file);

            // Update the setting
            $current_settings[$key] = $value;

            // Save the updated settings
            return $this->save($file, $current_settings);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }
}
