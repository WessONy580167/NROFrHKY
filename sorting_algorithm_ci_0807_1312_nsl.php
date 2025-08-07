<?php
// 代码生成时间: 2025-08-07 13:12:59
class SortingAlgorithmCI extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Sorts an array using a simple Bubble Sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function bubbleSort($array) {
        if (!is_array($array)) {
            // Handle error when input is not an array
            log_message('error', 'Input must be an array.');
            return [];
        }

        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // Swap the elements
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }

        return $array;
    }

    /**
     * Sorts an array using a simple Selection Sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function selectionSort($array) {
        if (!is_array($array)) {
            // Handle error when input is not an array
            log_message('error', 'Input must be an array.');
            return [];
        }

        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            // Find the minimum element in unsorted array
            $minIdx = $i;
            for ($j = $i + 1; $j < $n; $j++) {
                if ($array[$j] < $array[$minIdx]) {
                    $minIdx = $j;
                }
            }

            // Swap the found minimum element with the first element
            if ($minIdx != $i) {
                $temp = $array[$minIdx];
                $array[$minIdx] = $array[$i];
                $array[$i] = $temp;
            }
        }

        return $array;
    }

    /**
     * Test the sorting algorithms.
     */
    public function testSorting() {
        $testArray = [64, 34, 25, 12, 22, 11, 90];

        $sortedArrayBubble = $this->bubbleSort($testArray);
        $sortedArraySelection = $this->selectionSort($testArray);

        echo "Sorted array (Bubble Sort): ";
        print_r($sortedArrayBubble);

        echo "Sorted array (Selection Sort): ";
        print_r($sortedArraySelection);
    }
}
