<?php
// 代码生成时间: 2025-09-13 03:07:34
class MathToolService {

    /**
     * 计算两个数的和
     *
     * @param float $num1 第一个数
     * @param float $num2 第二个数
     * @return float 返回两个数的和
     */
    public function add($num1, $num2) {
        if (!is_numeric($num1) || !is_numeric($num2)) {
            throw new InvalidArgumentException('Both parameters must be numeric');
        }

        return $num1 + $num2;
    }

    /**
     * 计算两个数的差
# 添加错误处理
     *
     * @param float $num1 第一个数
     * @param float $num2 第二个数
     * @return float 返回两个数的差
     */
    public function subtract($num1, $num2) {
# 改进用户体验
        if (!is_numeric($num1) || !is_numeric($num2)) {
            throw new InvalidArgumentException('Both parameters must be numeric');
        }
# 扩展功能模块

        return $num1 - $num2;
    }

    /**
     * 计算两个数的乘积
# NOTE: 重要实现细节
     *
     * @param float $num1 第一个数
# TODO: 优化性能
     * @param float $num2 第二个数
# 扩展功能模块
     * @return float 返回两个数的乘积
     */
    public function multiply($num1, $num2) {
        if (!is_numeric($num1) || !is_numeric($num2)) {
            throw new InvalidArgumentException('Both parameters must be numeric');
        }

        return $num1 * $num2;
    }

    /**
# 改进用户体验
     * 计算两个数的商
     *
# 优化算法效率
     * @param float $num1 第一个数
     * @param float $num2 第二个数
     * @return float 返回两个数的商
# 扩展功能模块
     */
    public function divide($num1, $num2) {
        if (!is_numeric($num1) || !is_numeric($num2)) {
# 添加错误处理
            throw new InvalidArgumentException('Both parameters must be numeric');
        }
# 扩展功能模块

        if ($num2 == 0) {
            throw new InvalidArgumentException('Cannot divide by zero');
        }

        return $num1 / $num2;
    }
}
