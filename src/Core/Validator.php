<?php

namespace Core;

class Validator
{
    public static function string(string $value, int $min = 1, int $max = INF): int
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }
}
