<?php
// 代码生成时间: 2025-09-24 15:48:36
// ExcelGenerator.php
// 该类用于生成Excel文件

class ExcelGenerator {

    /**
     * @var string 存储Excel文件的路径
     */
    private $filePath;

    /**
     * @var PHPExcel 对象，用于操作Excel文件
     */
    private $objPHPExcel;

    public function __construct() {
        // 加载PHPExcel库
        require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
        $this->objPHPExcel = new PHPExcel();
    }

    /**
     * 设置Excel文件的路径
     *
     * @param string $filePath Excel文件的路径
     */
    public function setFilePath($filePath) {
        $this->filePath = $filePath;
    }

    /**
     * 添加一个工作表
     *
     * @param string $sheetName 工作表的名称
     */
    public function addSheet($sheetName) {
        $this->objPHPExcel->createSheet($sheetName);
    }

    /**
     * 在指定的工作表中添加数据
     *
     * @param array $data 要添加的数据
     * @param string $sheetName 工作表的名称，默认为第一个工作表
     */
    public function addData($data, $sheetName = '') {
        $sheet = (empty($sheetName)) ? $this->objPHPExcel->getActiveSheet() : $this->objPHPExcel->getSheetByName($sheetName);

        $row = 1; // 从第一行开始
        foreach ($data as $rowData) {
            foreach ($rowData as $col => $value) {
                $sheet->setCellValueByColumnAndRow($col + 1, $row, $value);
            }
            $row++;
        }
    }

    /**
     * 保存Excel文件
     *
     * @return bool 保存成功返回true，否则返回false
     */
    public function save() {
        try {
            $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
            $objWriter->save($this->filePath);
            return true;
        } catch (Exception $e) {
            // 错误处理
            log_message('error', 'Excel文件保存失败: ' . $e->getMessage());
            return false;
        }
    }

}
