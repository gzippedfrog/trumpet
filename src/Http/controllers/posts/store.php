<?php

use Core\App;
use Core\Database;
use Core\Validator;

$text = $_POST['text'];
$author_id = $_POST['author_id'];
$parent_id = $_POST['parent_id'] ?? NULL;

$errors = [];

if (!Validator::string($text, 1, 255)) {
    $errors['text'] = 'Please enter a post between 1 and 255 characters';
}

if (!empty($errors)) {
    view('index', compact('errors', 'text'));
}

$db = App::resolve(Database::class);

$stmt = 'INSERT INTO posts (text, author_id, parent_id)
         VALUES (:text, :author_id, :parent_id)';

$db->query($stmt, compact('text', 'author_id', 'parent_id'));

redirect('/');
