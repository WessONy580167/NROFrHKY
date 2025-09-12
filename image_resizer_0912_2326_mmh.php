<?php
// 代码生成时间: 2025-09-12 23:26:10
class ImageResizer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // 加载图片处理库
        $this->load->library('image_lib');
    }

    /**
     * 批量调整图片尺寸
     *
     * @param string $source_path 源图片文件夹路径
     * @param string $destination_path 目标文件夹路径
     * @param int $width 新图片宽度
     * @param int $height 新图片高度
     *
     * @return void
     */
    public function resize($source_path, $destination_path, $width, $height) {
        // 检查源文件夹路径是否存在
        if (!file_exists($source_path)) {
            log_message('error', "Source path does not exist: {$source_path}");
            return;
        }

        // 获取源文件夹内所有图片文件
        $files = scandir($source_path);

        foreach ($files as $file) {
            // 检查是否为图片文件
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                $config['image_library'] = 'gd2';
                $config['source_image'] = $source_path . '/' . $file;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $width;
                $config['height'] = $height;
                $config['new_image'] = $destination_path . '/' . $file;

                // 初始化图片处理库
                $this->image_lib->initialize($config);

                // 执行图片尺寸调整
                if (!$this->image_lib->resize()) {
                    log_message('error', 'Error resizing image: ' . $this->image_lib->display_errors());
                } else {
                    log_message('info', 'Image resized successfully: ' . $config['source_image']);
                }
            }
        }
    }

    public function index() {
        // 示例调用，批量调整图片尺寸
        // 请根据实际需要调整参数
        $source_path = '/path/to/source/images';
        $destination_path = '/path/to/destination/images';
        $width = 200;
        $height = 200;
        $this->resize($source_path, $destination_path, $width, $height);
    }
}
