<?php
// 代码生成时间: 2025-09-20 10:44:30
defined('BASEPATH') OR exit('No direct script access allowed');

class TextFileAnalyzer extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        // Load the necessary libraries and helpers
        $this->load->helper('file');
        $this->load->library('form_validation');
    }

    /**
     * Index Method for TextFileAnalyzer Controller.
     *
     * @return void
     */
    public function index() {
        // Check if a file has been uploaded
        if (!empty($_FILES['text_file']['name'])) {
            $uploadPath = './uploads/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'txt';
            $config['max_size'] = '2048';

            // Load and initialize upload library
            $this->load->library('upload', $config);

            // Perform the file upload
            if ($this->upload->do_upload('text_file')) {
                $fileData = $this->upload->data();
                $filePath = $fileData['full_path'];
                $this->analyzeFile($filePath);
            } else {
                // Handle upload error
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('text_file_analyzer');
            }
        } else {
            // Show the upload form
            $this->load->view('upload_form');
        }
    }

    /**
     * Analyze the content of the file and display statistics.
     *
     * @param string $filePath The path to the text file to analyze
     * @return void
     */
    private function analyzeFile($filePath) {
        // Read the file content
        $fileContent = file_get_contents($filePath);
        if ($fileContent === false) {
            // Handle file read error
            $this->session->set_flashdata('error', 'Unable to read the file.');
            redirect('text_file_analyzer');
        }

        // Perform analysis
        $analysisResults = $this->performAnalysis($fileContent);

        // Display results
        $data['results'] = $analysisResults;
        $this->load->view('analysis_results', $data);
    }

    /**
     * Perform analysis on the file content.
     *
     * @param string $content The content of the text file
     * @return array The analysis results
     */
    private function performAnalysis($content) {
        $wordCount = str_word_count($content);
        $lineCount = substr_count($content, "
");
        $charCount = strlen($content);

        return [
            'word_count' => $wordCount,
            'line_count' => $lineCount,
            'char_count' => $charCount,
        ];
    }
}
