<?php
// 代码生成时间: 2025-09-16 15:26:54
 * maintain, and extend, following PHP best practices.
 */
class WebContentGrabber {

    /**
     * @var string The URL to fetch content from
     */
    private $url;

    /**
     * @var string The fetched content
     */
    private $content;

    /**
     * Constructor to initialize the URL
     *
     * @param string $url The URL to fetch content from
     */
    public function __construct($url) {
        $this->url = $url;
    }

    /**
     * Fetch the content from the URL
     *
     * @return string The fetched content or an error message
     */
    public function fetchContent() {
        try {
            // Initialize cURL session
            $ch = curl_init($this->url);

            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Execute cURL session and fetch content
            $this->content = curl_exec($ch);

            // Check for errors
            if (curl_errno($ch)) {
                throw new Exception(curl_error($ch));
            }

            // Close cURL session
            curl_close($ch);

            return $this->content;

        } catch (Exception $e) {
            // Handle errors and return an error message
            return 'Error fetching content: ' . $e->getMessage();
        }
    }

    /**
     * Get the fetched content
     *
     * @return string The fetched content
     */
    public function getContent() {
        return $this->content;
    }

}

// Example usage
try {
    $url = 'https://example.com';
    $grabber = new WebContentGrabber($url);
    $content = $grabber->fetchContent();
    echo $content;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
