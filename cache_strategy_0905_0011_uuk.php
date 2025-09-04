<?php
// 代码生成时间: 2025-09-05 00:11:24
class CacheStrategy {
    /**
     * CodeIgniter instance
     *
     * @var CI_Controller
     */
    protected $ci;

    /**
     * Constructor
     *
     * @param CI_Controller $ci
     */
    public function __construct(CI_Controller $ci) {
        $this->ci = $ci;
    }

    /**
     * Set cache data
     *
     * @param string $key Cache key
     * @param mixed $data Data to be cached
     * @param int $ttl Time to live in seconds
     * @return bool
     */
    public function set($key, $data, $ttl = 3600) {
        try {
            $this->ci->cache->save($key, $data, $ttl);
            return true;
        } catch (Exception $e) {
            log_message('error', 'Cache set failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get cache data
     *
     * @param string $key Cache key
     * @return mixed
     */
    public function get($key) {
        try {
            $data = $this->ci->cache->get($key);
            if ($data === false) {
                log_message('debug', 'Cache data not found for key: ' . $key);
                return null;
            }
            return $data;
        } catch (Exception $e) {
            log_message('error', 'Cache get failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Delete cache data
     *
     * @param string $key Cache key
     * @return bool
     */
    public function delete($key) {
        try {
            $this->ci->cache->delete($key);
            return true;
        } catch (Exception $e) {
            log_message('error', 'Cache delete failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Clear all cache data
     *
     * @return bool
     */
    public function clear() {
        try {
            $this->ci->cache->clean();
            return true;
        } catch (Exception $e) {
            log_message('error', 'Cache clear failed: ' . $e->getMessage());
            return false;
        }
    }
}
