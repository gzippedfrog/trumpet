<?php

use Core\App;
use Core\Post;
use Core\User;
use Doctrine\ORM\EntityManager;

$user_id = isset($_SESSION['id']) ? (int)$_SESSION['id'] : null;
$post_id = isset($_POST['id']) ? (int)$_POST['id'] : null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : null;

$entityManager = App::resolve(EntityManager::class);

$post = $entityManager->find(Post::class, $post_id);
$user = $entityManager->find(User::class, $user_id);

$post->addLike($user);

$entityManager->persist($post);
$entityManager->flush();

redirect("/?page=$page");
