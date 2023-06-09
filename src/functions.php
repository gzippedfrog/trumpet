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

function getPost($id)
{
    $db = App::resolve(Database::class);

    return $db->query(
        'SELECT * FROM posts WHERE id = :post_id',
        ['post_id' => $id]
    )->fetch();
}

function getPosts($user_id, $page, $per_page)
{
    $db = App::resolve(Database::class);

    $stmt = 'SELECT
    posts.id,
    posts.text,
    posts.image,
    posts.author_id AS author_id,
    users.username AS author_username,
    COUNT(likes.user_id) AS likes,
    SUM(likes.user_id = :user_id) > 0 AS liked
    FROM posts
    JOIN users ON users.id = posts.author_id
    LEFT JOIN likes ON likes.post_id = posts.id
    WHERE posts.parent_id IS NULL
    GROUP BY posts.id
    ORDER BY posts.id DESC
    LIMIT :per_page OFFSET :page';

    $posts = $db->query(
        $stmt,
        [
            'user_id' => $user_id,
            'per_page' => [$per_page, PDO::PARAM_INT],
            'page' => [($page - 1) * $per_page, PDO::PARAM_INT]
        ]
    )->fetchAll();

    return $posts;
}

function getReplies($post_ids, $user_id)
{
    $db = App::resolve(Database::class);

    $inQuery = implode(', ', array_fill(0, count($post_ids), '?'));

    $stmt = 'SELECT
    posts.parent_id,
    posts.id,
    posts.text,
    posts.image,
    posts.author_id AS author_id,
    users.username AS author_username,
    COUNT(likes.user_id) AS likes,
    SUM(likes.user_id = ?) > 0 AS liked
    FROM posts
    JOIN users ON users.id = posts.author_id
    LEFT JOIN likes ON likes.post_id = posts.id
    WHERE posts.parent_id IN (' . $inQuery . ')
    GROUP BY posts.id';

    $replies = $db->queryPositional(
        $stmt,
        array_merge([$user_id], $post_ids)
    )->fetchAll(PDO::FETCH_GROUP);

    return $replies;
}

function getPages($per_page)
{
    $db = App::resolve(Database::class);

    $stmt = 'SELECT COUNT(*) FROM posts WHERE posts.parent_id IS NULL';

    $posts = $db->query($stmt)->fetchColumn();

    return ceil($posts / $per_page);
}