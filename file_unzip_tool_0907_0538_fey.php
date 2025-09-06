<?php
// 代码生成时间: 2025-09-07 05:38:26
class FileUnzipTool {

    /**
     * 解压ZIP文件
     *
     * @param string $zipFilePath ZIP文件路径
     * @param string $destination 解压目的地路径
     * @return bool 返回解压是否成功
     */
    public function unzip($zipFilePath, $destination) {
        // 检查ZIP文件是否存在
        if (!file_exists($zipFilePath)) {
            // 日志错误信息
            log_message('error', 'ZIP文件不存在: ' . $zipFilePath);
            return false;
        }

        // 检查目的地路径是否存在
        if (!is_dir($destination)) {
            // 创建目录
            if (!mkdir($destination, 0777, true)) {
                // 日志错误信息
                log_message('error', '无法创建目录: ' . $destination);
                return false;
            }
        }

        // 创建ZipArchive对象
        $zip = new ZipArchive();

        // 打开ZIP文件
        if ($zip->open($zipFilePath) === true) {
            // 将文件解压到指定目录
            $zip->extractTo($destination);
            // 关闭ZIP文件
            $zip->close();
            return true;
        } else {
            // 日志错误信息
            log_message('error', '无法打开ZIP文件: ' . $zipFilePath);
            return false;
        }
    }
}

// 实例化工具类
$unzipTool = new FileUnzipTool();

// 解压示例
$zipFilePath = 'path_to_your_zip_file.zip';
$destination = 'path_to_extracted_files_directory';

if ($unzipTool->unzip($zipFilePath, $destination)) {
    echo '文件解压成功';
} else {
    echo '文件解压失败';
}
