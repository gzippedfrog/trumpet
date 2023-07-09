<?php

use Core\App;
use Core\Post;
use Core\User;
use Doctrine\ORM\EntityManager;
use Http\Forms\PostForm;

$user_id = isset($_SESSION['id']) ? (int)$_SESSION['id'] : null;
$post_text = isset($_POST['text']) ? (string)$_POST['text'] : null;
$parent_id = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : null;

PostForm::validate(['text' => $post_text]);

$entityManager = App::resolve(EntityManager::class);

$user = $entityManager->find(User::class, $user_id);

$post = new Post();
$post->setText($post_text);
$post->setAuthor($user);

if ($parent_id) {
    $parent = $entityManager->find(Post::class, $parent_id);
    $post->setParent($parent);
}

if (!empty($_FILES['image']['size'])) {
    $upload_dir = base_path("../public/images");
    $tmp_name = $_FILES['image']['tmp_name'];

    $file_name_array = explode('.', $_FILES['image']['name']);
    $ext = end($file_name_array);
    $file_name = uniqid() . '.' . $ext;

    move_uploaded_file($tmp_name, "$upload_dir/$file_name");

    $post->setImage($file_name);
}

$entityManager->persist($post);
$entityManager->flush();

redirect("/?page=$page");
