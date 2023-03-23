<?php

use Core\App;
use Core\Database;
use Core\Validator;

$text = $_POST['text'];
$author_id = $_POST['author_id'];

$errors = [];

if (!Validator::string($text, 1, 255)) {
    $errors['text'] = 'Please enter a post between 1 and 255 characters';
}

if (!empty($errors)) {
    return view('index', compact('errors', 'text'));
}

$db = App::resolve(Database::class);

$stmt = 'INSERT INTO posts (text, author_id)
         VALUES (:text, :author_id)';

$db->query($stmt, compact('text', 'author_id'));

header('Location: /');
exit();
