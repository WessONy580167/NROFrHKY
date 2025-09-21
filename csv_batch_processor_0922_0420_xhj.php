<?php
// 代码生成时间: 2025-09-22 04:20:03
defined('BASEPATH') OR exit('No direct script access allowed');

class CsvBatchProcessor extends CI_Controller {

    /**
     * 上传CSV文件并处理
     */
    public function uploadAndProcess() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = 2048;
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('csv_file')) {
            // 上传失败处理
            $error = array('error' => $this->upload->display_errors());
            $this->output->set_status_header(400);
            $this->output->set_content_type('application/json', 'utf-8');
            echo json_encode($error);
            return;
        } else {
            // 上传成功，开始处理文件
            $upload_data = $this->upload->data();
            $file_path = $upload_data['full_path'];
            
            try {
                $this->processCsvFile($file_path);
                
                // 处理成功
                $response = array('message' => 'CSV file processed successfully');
                $this->output->set_status_header(200);
                $this->output->set_content_type('application/json', 'utf-8');
                echo json_encode($response);
            } catch (Exception $e) {
                // 错误处理
                $this->output->set_status_header(500);
                $this->output->set_content_type('application/json', 'utf-8');
                echo json_encode(array('error' => $e->getMessage()));
            }
        }
    }

    /**
     * 处理CSV文件
     *
     * @param string $file_path CSV文件路径
     */
    private function processCsvFile($file_path) {
        if (($handle = fopen($file_path, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // 根据CSV文件内容执行相应的操作
                // 例如：插入数据库、发送邮件等
                
                // 示例：插入数据库
                $this->load->model('your_model');
                $this->your_model->insertData($data);
            }
            fclose($handle);
        } else {
            throw new Exception('Unable to open CSV file');
        }
    }
}
