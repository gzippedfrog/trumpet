<?php

use Core\App;
use Core\Database;
use Core\Response;

function dd(mixed $value): never
{
    echo '<pre>';
    var_export($value);
    echo '</pre>';
    exit();
}

function base_path(string $path): string
{
    return BASE_PATH . $path;
}

function view(string $path, array $attributes = []): void
{
    extract($attributes);
    require base_path("views/$path.view.php");
}

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

function authorize(bool $condition, int $status = Response::FORBIDDEN): bool
{
    if (!$condition) {
        abort($status);
    }

    return true;
}

function redirect(string $path): never
{
    header("Location: $path");
    exit();
}

function flashed(string $key, mixed $default = ''): mixed
{
    return Core\Session::get('_flash')[$key] ?? $default;
}

function old(string $key, mixed $default = ''): mixed
{
    return Core\Session::get('old')[$key] ?? $default;
}

function validatePageNumber(?int $page, int $pages_total, array $params): void
{
    if ($page < 1 || $page > $pages_total) {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $params['page'] = 1;
        redirect("$uri?" . http_build_query($params));
    }
}