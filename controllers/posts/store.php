<?php

use Core\App;
use Core\Database;
use Core\Validator;

$body = $_POST['body'];
$author_id = $_POST['author_id'];

$errors = [];

if (!Validator::string($body, 1, 255)) {
    $errors['username'] = 'Please enter a post between 100 and 255 characters';
}

if (!empty($errors)) {
    return view('posts/index', compact('errors', 'body'));
}

$db = App::resolve(Database::class);

$stmt = 'INSERT INTO posts (body, author_id)
         VALUES (:body, :author_id)';

$db->query($stmt, compact('body', 'author_id'));

header('Location: /');
exit();
