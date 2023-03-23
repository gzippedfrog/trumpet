<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$stmt = 'SELECT * FROM posts WHERE id = :post_id';

$post = $db->query($stmt, ['post_id' => $_GET['id']])->fetch();

if ($_SESSION['id'] !== $post['author_id']) {
    abort(403, 'You are not authorized for this action');
}

view('posts/edit', compact('post'));
