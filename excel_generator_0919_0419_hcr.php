<?php
// 代码生成时间: 2025-09-19 04:19:57
// 文件路径：application/controllers/ExcelGenerator.php
// 用途：提供一个Excel表格自动生成器

class ExcelGenerator extends CI_Controller {
    // 使用CodeIgniter加载器加载Excel类
    public function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }

    // 生成Excel文件
    public function generate($template, $data) {
        // 检查模板是否存在
        if (!file_exists($template)) {
            $this->output->set_status_header(404);
            echo json_encode(array('error' => 'Template file not found'));
            return;
        }

        // 加载模板
        $objPHPExcel = PHPExcel_IOFactory::load($template);

        // 设置活动表单
        $objPHPExcel->setActiveSheetIndex(0);

        // 填充数据
        foreach ($data as $rowIndex => $rowData) {
            $column = 'A';
            foreach ($rowData as $cellValue) {
                $objPHPExcel->getActiveSheet()->setCellValue($column . ($rowIndex + 1), $cellValue);
                $column++;
            }
        }

        // 设置HTTP响应头
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . urlencode('generated_file.xlsx') . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public'); // HTTP/1.0

        // 写入Excel文件并输出
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    // 下载示例模板
    public function downloadTemplate($filename) {
        // 检查文件是否存在
        if (!file_exists($filename)) {
            $this->output->set_status_header(404);
            echo json_encode(array('error' => 'File not found'));
            return;
        }

        // 设置HTTP响应头
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . urlencode($filename) . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public'); // HTTP/1.0

        // 读取并输出文件
        readfile($filename);
    }
}
