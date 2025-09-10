<?php
// 代码生成时间: 2025-09-11 05:12:08
class SortingService {
# 优化算法效率

    private $data;

    public function __construct(array $data) {
        // Assign the data to a private property
        $this->data = $data;
    }

    // Sorts the data using bubble sort algorithm
    public function bubbleSort() {
        $length = count($this->data);
        for ($i = 0; $i < $length - 1; $i++) {
            for ($j = 0; $j < $length - $i - 1; $j++) {
                if ($this->data[$j] > $this->data[$j + 1]) {
                    // Swap the elements
                    $temp = $this->data[$j];
                    $this->data[$j] = $this->data[$j + 1];
                    $this->data[$j + 1] = $temp;
                }
            }
# NOTE: 重要实现细节
        }
    }

    // Sorts the data using selection sort algorithm
    public function selectionSort() {
        for ($i = 0; $i < count($this->data); $i++) {
            $minIndex = $i;
            for ($j = $i + 1; $j < count($this->data); $j++) {
                if ($this->data[$j] < $this->data[$minIndex]) {
                    $minIndex = $j;
# 增强安全性
                }
            }
            // Swap the found minimum element with the first element of the unsorted part
            $temp = $this->data[$minIndex];
            $this->data[$minIndex] = $this->data[$i];
            $this->data[$i] = $temp;
        }
    }
# FIXME: 处理边界情况

    // Sorts the data using insertion sort algorithm
    public function insertionSort() {
        for ($i = 1; $i < count($this->data); $i++) {
            $key = $this->data[$i];
            $j = $i - 1;

            while ($j >= 0 && $this->data[$j] > $key) {
# TODO: 优化性能
                $this->data[$j + 1] = $this->data[$j];
                $j--;
            }
            $this->data[$j + 1] = $key;
        }
    }

    // Get sorted data
    public function getSortedData() {
        return $this->data;
# 增强安全性
    }
}
