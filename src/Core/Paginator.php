<?php

namespace Core;

class Paginator
{
    public static function getPrevPageUrl($params)
    {
        if ($params['page'] < 2) return;

        $params['page']--;
        return '/?' . http_build_query($params);
    }

    public static function getNextPageUrl($params, $totalPages)
    {
        if ($params['page'] >= $totalPages) return;

        $params['page']++;
        return '/?' . http_build_query($params);
    }
}