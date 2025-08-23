<?php
// 代码生成时间: 2025-08-23 14:45:43
class FileUnzipper {

    private $ci;

    /**
     * 构造函数
     *
     * 加载 CodeIgniter 的实例
     */
    public function __construct() {
        $this->ci =& get_instance();
    }

    /**
     * 解压文件
     *
     * @param string $source 压缩文件路径
     * @param string $destination 目标解压目录
     * @return bool|\stdClass
     */
    public function unzip($source, $destination) {
        // 检查文件是否存在
        if (!file_exists($source)) {
            return (object) ['status' => false, 'message' => '文件不存在'];
        }

        // 创建目标目录
        if (!is_dir($destination)) {
            mkdir($destination, 0777, true);
        }

        // 检查压缩文件类型
        $zip = new ZipArchive;
        if ($zip->open($source) === true) {
            $zip->extractTo($destination);
            $zip->close();
            return (object) ['status' => true, 'message' => '文件解压成功'];
        } else {
            return (object) ['status' => false, 'message' => '无法打开压缩文件'];
        }
    }
}
