<?php

use Core\App;
use Core\Post;
use Core\User;
use Doctrine\ORM\EntityManager;
use Http\Forms\PostForm;

$page = $_GET['page'];
$post_text = $_POST['text'];
$parent_id = $_POST['parent_id'] ?? null;
$user_id = $_SESSION['id'];

PostForm::validate(['text' => $post_text]);

/** @var EntityManager $entityManager */
$entityManager = App::resolve(EntityManager::class);

$post = new Post();
$user = $entityManager->find(User::class, $user_id);

$post->text = $post_text;
$post->author = $user;

if ($parent_id) {
    $parent = $entityManager->find(Post::class, $parent_id);
    $post->parent = $parent;
}

if ($_FILES['image'] ?? false) {
    $upload_dir = base_path("../public/images");
    $tmp_name = $_FILES['image']['tmp_name'];

    $file_name_array = explode('.', $_FILES['image']['name']);
    $ext = end($file_name_array);
    $file_name = uniqid() . '.' . $ext;

    move_uploaded_file($tmp_name, "$upload_dir/$file_name");

    $post->image = $file_name;
}

$entityManager->persist($post);
$entityManager->flush();

redirect("/?page=$page");
