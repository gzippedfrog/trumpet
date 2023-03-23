<?php

use Core\App;
use Core\Database;
use Core\Validator;

$text = $_POST['text'];
$id = $_POST['id'];

$db = App::resolve(Database::class);

$post = $db->query(
    'SELECT * from posts WHERE id = :id',
    compact('id')
)->fetch();


if ($_SESSION['id'] !== $post['author_id']) {
    abort(403, 'You are not authorized for this action');
}

$errors = [];

if (!Validator::string($text, 1, 255)) {
    $errors['text'] = 'Please enter a post between 1 and 255 characters';
}

if (!empty($errors)) {
    $post['text'] = $text;
    return view("posts/edit", compact('errors', 'post'));
}

$db->query(
    'UPDATE posts SET text = :text WHERE id = :id',
    compact('text', 'id')
);

header('Location: /');
exit();
