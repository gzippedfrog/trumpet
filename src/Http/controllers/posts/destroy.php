<?php

use Core\App;
use Core\Post;
use Doctrine\ORM\EntityManager;

$page = $_GET['page'];
$post_id = $_POST['id'];
$user_id = $_SESSION['id'];

/** @var EntityManager $entityManager */
$entityManager = App::resolve(EntityManager::class);

$post = $entityManager->find(Post::class, $post_id);

authorize($user_id === $post->author->id);

$entityManager->remove($post);
$entityManager->flush();

redirect("/?page=$page");
