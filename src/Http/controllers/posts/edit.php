<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$post = $db->query(
    'SELECT * FROM posts WHERE id = :post_id',
    [
        'post_id' => $_GET['id']
    ]
)->fetch();

authorize($_SESSION['id'] === $post['author_id']);

view('posts/edit', [
    'post' => $post
]);