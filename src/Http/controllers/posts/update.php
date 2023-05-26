<?php

use Core\App;
use Core\Database;
use Http\Forms\PostForm;

PostForm::validate([
    'text' => $_POST['text']
]);

$db = App::resolve(Database::class);

$post = $db->query(
    'SELECT * from posts WHERE id = :id',
    [
        'id' => $_POST['id']
    ]
)->fetch();

authorize($_SESSION['id'] === $post['author_id']);

$db->query(
    'UPDATE posts SET text = :text WHERE id = :id',
    [
        'id' => $_POST['id'],
        'text' => $_POST['text'],
    ]
);

redirect('/');