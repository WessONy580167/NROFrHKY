<?php
// 代码生成时间: 2025-08-30 10:13:02
 * Interactive Chart Generator using PHP and CodeIgniter framework
 *
 * This class provides functionality to generate interactive charts based on provided data.
 *
 * @author Your Name
 * @version 1.0
 */
class InteractiveChartGenerator {

    /**
     * CodeIgniter instance
     *
     * @var object
     */
    private $ci;

    /**
     * Constructor
     *
     * Initialize the CodeIgniter instance
     */
    public function __construct() {
        // Get the CodeIgniter instance
        $this->ci =& get_instance();
    }

    /**
     * Generate an interactive chart
     *
     * @param array $data Chart data in the format of [label => [value1, value2, ...]]
     * @param string $chartType Type of chart (e.g., 'line', 'bar', 'pie')
     * @return string HTML code for the chart
     */
    public function generateChart(array $data, string $chartType) {
        // Check for valid data
        if (empty($data)) {
            throw new InvalidArgumentException('No data provided for the chart.');
        }

        // Check for valid chart type
        $validChartTypes = ['line', 'bar', 'pie'];
        if (!in_array($chartType, $validChartTypes)) {
            throw new InvalidArgumentException('Invalid chart type. Please choose from: ' . implode(', ', $validChartTypes));
        }

        // Load the required libraries
        $this->ci->load->library('chartjs');

        // Initialize the chart options
        $options = [
            'type' => $chartType,
            'data' => $data,
            'options' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['display' => true]
                ]
            ]
        ];

        // Generate the chart HTML
        $chartHtml = $this->ci->chartjs->generateChart($options);

        // Return the chart HTML
        return $chartHtml;
    }

    /**
     * Example usage
     */
    public function exampleUsage() {
        try {
            // Sample data for a pie chart
            $chartData = [
                'Label 1' => [30],
                'Label 2' => [40],
                'Label 3' => [30]
            ];

            // Generate the chart
            $chartType = 'pie';
            $chartHtml = $this->generateChart($chartData, $chartType);

            // Output the chart HTML
            echo $chartHtml;
        } catch (Exception $e) {
            // Handle any errors
            log_message('error', $e->getMessage());
        }
    }
}
