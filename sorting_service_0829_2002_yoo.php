<?php
// 代码生成时间: 2025-08-29 20:02:00
class SortingService 
{

    /**
     * Sorts an array using the Bubble Sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function bubbleSort(array $array): array 
    {
        if (empty($array)) {
            // Handle error when array is empty.
            throw new InvalidArgumentException('Array must not be empty.');
        }

        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // Swap elements if they are in the wrong order.
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }

        return $array;
    }

    /**
     * Sorts an array using the Quick Sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function quickSort(array $array): array 
    {
        if (empty($array)) {
            // Handle error when array is empty.
            throw new InvalidArgumentException('Array must not be empty.');
        }

        if (count($array) < 2) {
            return $array;
        }

        $less = $greater = [];
        $pivot = array_shift($array);

        foreach ($array as $value) {
            if ($value <= $pivot) {
                $less[] = $value;
            } else {
                $greater[] = $value;
            }
        }

        return array_merge($this->quickSort($less), [$pivot], $this->quickSort($greater));
    }

    // Additional sorting algorithms can be added here...

}
