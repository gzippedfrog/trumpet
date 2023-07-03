<?php

use Core\Response;

/**
 * @param mixed $value
 * @return never
 */
function dd(mixed $value): never
{
    echo '<pre>';
    var_export($value);
    echo '</pre>';
    exit();
}

/**
 * @param string $path
 * @return string
 */
function base_path(string $path): string
{
    return BASE_PATH . $path;
}

/**
 * @param string $path
 * @param array $attributes
 * @return void
 */
function view(string $path, array $attributes = []): void
{
    extract($attributes);
    require base_path("views/$path.view.php");
}

/**
 * @param int $code
 * @return never
 */
function abort(int $code = Response::NOT_FOUND): never
{
    $message = match ($code) {
        Response::NOT_FOUND => 'Page not found',
        Response::FORBIDDEN => 'You are not authorized for this action',
        default => 'Unknown Error'
    };

    http_response_code($code);

    view('error', [
        'code' => $code,
        'message' => $message
    ]);

    exit();
}

/**
 * @param bool $condition
 * @param int $status
 * @return bool
 */
function authorize(bool $condition, int $status = Response::FORBIDDEN): bool
{
    if (!$condition) {
        abort($status);
    }

    return true;
}

/**
 * @param string $path
 * @return never
 */
function redirect(string $path): never
{
    header("Location: $path");
    exit();
}

/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function flashed(string $key, mixed $default = ''): mixed
{
    return Core\Session::get('_flash')[$key] ?? $default;
}

/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function old(string $key, mixed $default = ''): mixed
{
    return Core\Session::get('old')[$key] ?? $default;
}

/**
 * @param int|null $page
 * @param int $pages_total
 * @param array $params
 * @return void
 */
function validatePageNumber(?int $page, int $pages_total, array $params): void
{
    if ($page < 1 || $page > $pages_total) {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $params['page'] = 1;
        redirect("$uri?" . http_build_query($params));
    }
}