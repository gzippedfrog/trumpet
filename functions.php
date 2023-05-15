<?php

function dd($value)
{
    echo '<pre>';
    var_dump($value);
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

function abort($code = 404, $message = 'Page not found')
{
    http_response_code($code);

    view('error', compact('code', 'message'));

    exit();
}

function redirect($path)
{
    header("Location: $path");
    exit();
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}
