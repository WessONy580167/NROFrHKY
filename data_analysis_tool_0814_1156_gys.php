<?php
// 代码生成时间: 2025-08-14 11:56:35
class DataAnalysisTool {

    /**
     * 计算数据的平均值
     *
     * @param array $data 数据数组
     * @return float|null 平均值
     */
    public function calculateAverage(array $data) {
        if (empty($data)) {
            // 数据为空时返回null
            return null;
        }

        $sum = array_sum($data);
        $count = count($data);
        return $sum / $count;
    }

    /**
     * 计算数据的最大值
     *
     * @param array $data 数据数组
     * @return mixed 最大值
     */
    public function calculateMax(array $data) {
        if (empty($data)) {
            // 数据为空时返回null
            return null;
        }

        return max($data);
    }

    /**
     * 计算数据的最小值
     *
     * @param array $data 数据数组
     * @return mixed 最小值
     */
    public function calculateMin(array $data) {
        if (empty($data)) {
            // 数据为空时返回null
            return null;
        }

        return min($data);
    }

    /**
     * 计算数据的标准差
     *
     * @param array $data 数据数组
     * @return float 标准差
     */
    public function calculateStandardDeviation(array $data) {
        if (empty($data)) {
            // 数据为空时返回null
            return null;
        }

        $avg = $this->calculateAverage($data);
        $sum = 0;
        foreach ($data as $value) {
            $sum += pow($value - $avg, 2);
        }

        $count = count($data);
        return sqrt($sum / $count);
    }

    /**
     * 计算数据的中位数
     *
     * @param array $data 数据数组
     * @return float 中位数
     */
    public function calculateMedian(array $data) {
        if (empty($data)) {
            // 数据为空时返回null
            return null;
        }

        sort($data);
        $count = count($data);
        $middleIndex = floor(($count - 1) / 2);
        if ($count % 2) {
            // 奇数个数据时返回中间值
            return $data[$middleIndex];
        } else {
            // 偶数个数据时返回中间两个值的平均值
            return ($data[$middleIndex] + $data[$middleIndex + 1]) / 2;
        }
    }

}
