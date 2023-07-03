<?php

namespace Core;

class Paginator
{
    /**
     * @param array $params
     * @return string|null
     */
    public static function getPrevPageUrl(array $params): string|null
    {
        if ($params['page'] < 2) return null;

        return '/?page=' . $params['page'] - 1;
    }

    /**
     * @param array $params
     * @param int $totalPages
     * @return string|null
     */
    public static function getNextPageUrl(array $params, int $totalPages): string|null
    {
        if ($params['page'] >= $totalPages) return null;

        return '/?page=' . $params['page'] + 1;
    }
}