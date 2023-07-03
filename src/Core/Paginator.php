<?php

namespace Core;

class Paginator
{
    public static function getPrevPageUrl(array $params): string|null
    {
        if ($params['page'] < 2) return null;

        return '/?page=' . $params['page'] - 1;
    }

    public static function getNextPageUrl(array $params, int $totalPages): string|null
    {
        if ($params['page'] >= $totalPages) return null;

        return '/?page=' . $params['page'] + 1;
    }
}