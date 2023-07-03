<?php

namespace Core;

class Validator
{
    /**
     * @param string $value
     * @param int $min
     * @param int $max
     * @return int
     */
    public static function string(string $value, int $min = 1, int $max = INF): int
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }
}
