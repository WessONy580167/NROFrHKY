<?php
// 代码生成时间: 2025-08-11 09:20:33
// SortingAlgorithm.php
// 这是一个使用PHP和CodeIgniter框架实现排序算法的程序

class SortingAlgorithm {
    // 构造函数
    public function __construct() {
        // 这里可以初始化一些需要的资源
    }

    // 冒泡排序算法实现
    public function bubbleSort($array) {
        $size = count($array);
        for ($i = 0; $i < $size - 1; $i++) {
            for ($j = 0; $j < $size - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // 交换两个元素的位置
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }
        return $array;
    }

    // 选择排序算法实现
    public function selectionSort($array) {
        $size = count($array);
        for ($i = 0; $i < $size - 1; $i++) {
            // 找到最小元素的索引
            $min_index = $i;
            for ($j = $i + 1; $j < $size; $j++) {
                if ($array[$j] < $array[$min_index]) {
                    $min_index = $j;
                }
            }
            // 交换当前位置与最小元素的位置
            $temp = $array[$i];
            $array[$i] = $array[$min_index];
            $array[$min_index] = $temp;
        }
        return $array;
    }

    // 插入排序算法实现
    public function insertionSort($array) {
        for ($i = 1; $i < count($array); $i++) {
            $key = $array[$i];
            $j = $i - 1;
            while ($j >= 0 && $array[$j] > $key) {
                $array[$j + 1] = $array[$j];
                $j = $j - 1;
            }
            $array[$j + 1] = $key;
        }
        return $array;
    }

    // 快速排序算法实现
    public function quickSort($array) {
        if (count($array) < 2) {
            return $array;
        }
        $left = $right = array();
        $pivot = array_shift($array);
        foreach ($array as $item) {
            if ($item <= $pivot) {
                $left[] = $item;
            } else {
                $right[] = $item;
            }
        }
        return array_merge($this->quickSort($left), array($pivot), $this->quickSort($right));
    }
}

// 使用示例
$sortingAlgorithm = new SortingAlgorithm();
$unsortedArray = array(4, 2, 5, 3, 1);
$sortedArray = $sortingAlgorithm->quickSort($unsortedArray);
print_r($sortedArray);
