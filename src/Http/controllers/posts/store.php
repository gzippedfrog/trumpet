<?php

use Core\App;
use Core\Database;
use Http\Forms\PostForm;

PostForm::validate([
    'text' => $_POST['text']
]);

$db = App::resolve(Database::class);

$stmt = 'INSERT INTO posts (text, author_id, parent_id)
         VALUES (:text, :author_id, :parent_id)';

$db->query($stmt, [
    'text' => $_POST['text'],
    'author_id' => $_POST['author_id'],
    'parent_id' => $_POST['parent_id'] ?? null
]);

redirect('/');