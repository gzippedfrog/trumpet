<?php

use Core\App;
use Core\Post;
use Doctrine\ORM\EntityManager;

$user_id = isset($_SESSION['id']) ? (int)$_SESSION['id'] : null;
$post_id = isset($_POST['id']) ? (int)$_POST['id'] : null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : null;

$entityManager = App::resolve(EntityManager::class);

$post = $entityManager->find(Post::class, $post_id);

$post->removeLike($user_id);

$entityManager->persist($post);
$entityManager->flush();

redirect("/?page=$page");
