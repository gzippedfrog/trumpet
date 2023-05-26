<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$post = $db->query(
    'SELECT * from posts where id = :id',
    [
        'id' => $_POST['id']
    ]
)->fetch();

authorize($_SESSION['id'] === $post['author_id']);

$db->query(
    'DELETE FROM posts where id = :id',
    [
        'id' => $_POST['id']
    ]
);

redirect('/');