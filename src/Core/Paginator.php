<?php

namespace Core;

class Paginator
{
    public static function getPrevPageUrl($params)
    {
        if ($params['page'] < 2) return;

        return '/?page=' . $params['page'] - 1;
    }

    public static function getNextPageUrl($params, $totalPages)
    {
        if ($params['page'] >= $totalPages) return;

        return '/?page=' . $params['page'] + 1;
    }
}