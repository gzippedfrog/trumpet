<?php

use Core\App;
use Core\Database;
use Http\Forms\PostForm;

PostForm::validate(['text' => $_POST['text']]);

if ($_FILES['image'] ?? false) {
    $upload_dir = base_path("../public/images");
    $tmp_name = $_FILES['image']['tmp_name'];

    $file_name_array = explode('.', $_FILES['image']['name']);
    $ext = end($file_name_array);
    $file_name = uniqid() . '.' . $ext;

    move_uploaded_file($tmp_name, "$upload_dir/$file_name");
}

$db = App::resolve(Database::class);

$stmt = 'INSERT INTO posts (text, author_id, parent_id, image)
VALUES (:text, :author_id, :parent_id, :image)';

$db->query($stmt, [
    'text' => $_POST['text'],
    'author_id' => $_SESSION['id'],
    'parent_id' => $_POST['parent_id'] ?? null,
    'image' => $file_name ?? null,
]);

redirect('/');