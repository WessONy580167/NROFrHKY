<?php
// 代码生成时间: 2025-09-18 10:08:56
class ConfigManager {

    /**
     * CI Super Global
     *
     * @var CI_Controller
     */
    protected $CI;

    /**
     * Constructor
     *
     * Loads the CI_Controller class
     *
     * @return void
     */
    public function __construct() {
        // Get the CI super-object
        $this->CI = &get_instance();
    }

    /**
     * Load Configuration File
     *
     * Loads a configuration file
     *
     * @param string $filename The name of the configuration file
     * @return void
     */
    public function load($filename) {
        try {
            // Load the configuration file
            $this->CI->config->load($filename);
        } catch (Exception $e) {
            // Handle errors
            log_message('error', 'Failed to load configuration file: ' . $filename . ' - ' . $e->getMessage());
            show_error('Unable to load configuration file: ' . $filename);
        }
    }

    /**
     * Save Configuration File
     *
     * Saves a configuration file
     *
     * @param string $filename The name of the configuration file
     * @param array $data The configuration data to save
     * @return bool
     */
    public function save($filename, $data) {
        try {
            // Write the configuration data to a file
            $file = fopen(APPPATH . 'config/' . $filename . '.php', 'w');
            if ($file) {
                $content = '<?php

' . '/*
 * Configuration file
 */

return ' . var_export($data, true) . ';';
                fwrite($file, $content);
                fclose($file);
                return true;
            } else {
                throw new Exception('Unable to open configuration file for writing.');
            }
        } catch (Exception $e) {
            // Handle errors
            log_message('error', 'Failed to save configuration file: ' . $filename . ' - ' . $e->getMessage());
            show_error('Unable to save configuration file: ' . $filename);
            return false;
        }
    }

    /**
     * Get Configuration Item
     *
     * Retrieves a configuration item
     *
     * @param string $item The configuration item to retrieve
     * @return mixed
     */
    public function item($item) {
        return $this->CI->config->item($item);
    }

    /**
     * Get All Configuration Items
     *
     * Retrieves all configuration items
     *
     * @return array
     */
    public function all() {
        return $this->CI->config->all();
    }

}
