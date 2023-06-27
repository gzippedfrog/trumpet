<?php

use Core\App;
use Core\Database;
use Core\Response;

function dd($value)
{
    echo '<pre>';
    var_export($value);
    echo '</pre>';
    exit();
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path("views/$path.view.php");
}

function abort($code = Response::NOT_FOUND)
{
    switch ($code) {
        case Response::NOT_FOUND:
            $message = 'Page not found';
            break;
        case Response::FORBIDDEN:
            $message = 'You are not authorized for this action';
            break;
        default:
            $message = '';
            break;
    }

    http_response_code($code);

    view('error', [
        'code' => $code,
        'message' => $message
    ]);

    exit();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }

    return true;
}

function redirect($path)
{
    header("Location: $path");
    exit();
}

function flashed($key, $default = '')
{
    return Core\Session::get('_flash')[$key] ?? $default;
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}

function validatePageNumber($page, $pages_total, $params)
{
    if ($page < 1 || $page > $pages_total) {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $params['page'] = 1;
        redirect("$uri?" . http_build_query($params));
    }
}