<?php
// 代码生成时间: 2025-09-01 04:48:55
class NetworkStatusChecker {

    /**
     * 检查指定URL是否可达。
     *
     * @param string $url 要检查的URL。
     * @return bool 返回true如果URL可达，否则返回false。
     */
    public function checkUrl($url) {
        // 使用cURL检查网络连接状态
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 设置超时时间为10秒

        // 执行cURL请求
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // 关闭cURL会话
        curl_close($ch);

        // 如果cURL请求成功且HTTP状态码为200，则认为URL可达
        return ($result !== false && $httpCode == 200);
    }

    /**
     * 检查本地网络连接状态。
     *
     * @return bool 返回true如果本地网络连接正常，否则返回false。
     */
    public function checkLocalNetwork() {
        try {
            // 尝试Ping本地网关
            $ping = exec('ping -c 1 ' . escapeshellarg(gethostbyname(gethostname())), $output, $return_var);

            // 如果Ping命令执行成功，则认为本地网络连接正常
            return ($return_var === 0);
        } catch (Exception $e) {
            // 如果发生异常，则记录错误日志并返回false
            log_message('error', 'Error checking local network: ' . $e->getMessage());
            return false;
        }
    }
}
