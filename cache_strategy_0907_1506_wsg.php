<?php
// 代码生成时间: 2025-09-07 15:06:22
class CacheStrategy {

    /**
     * CodeIgniter instance
     * @var CI_Controller
     */
    private $CI;

    public function __construct() {
        // Get the CodeIgniter instance
        $this->CI =& get_instance();
    }

    /**
     * Set cache for a given key and value
     * @param string $key The cache key
     * @param mixed $value The value to cache
     * @param int $ttl Time to live in seconds
     * @return bool Returns true on success or false on failure
     */
    public function setCache($key, $value, $ttl = 3600) {
        try {
            // Use CodeIgniter's caching library
            $this->CI->cache->save($key, $value, $ttl);
            return true;
        } catch (Exception $e) {
            // Log the error and return false
            log_message('error', 'Cache set error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get cached value for a given key
     * @param string $key The cache key
     * @return mixed Returns the cached value or null if not found
     */
    public function getCache($key) {
        try {
            // Use CodeIgniter's caching library
            return $this->CI->cache->get($key);
        } catch (Exception $e) {
            // Log the error and return null
            log_message('error', 'Cache get error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Delete cache for a given key
     * @param string $key The cache key
     * @return bool Returns true on success or false on failure
     */
    public function deleteCache($key) {
        try {
            // Use CodeIgniter's caching library
            $this->CI->cache->delete($key);
            return true;
        } catch (Exception $e) {
            // Log the error and return false
            log_message('error', 'Cache delete error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Clear all cache
     * @return bool Returns true on success or false on failure
     */
    public function clearCache() {
        try {
            // Use CodeIgniter's caching library
            $this->CI->cache->clean();
            return true;
        } catch (Exception $e) {
            // Log the error and return false
            log_message('error', 'Cache clear error: ' . $e->getMessage());
            return false;
        }
    }
}
