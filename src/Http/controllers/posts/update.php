<?php

use Core\App;
use Core\Post;
use Doctrine\ORM\EntityManager;
use Http\Forms\PostForm;

$user_id = isset($_SESSION['id']) ? (int)$_SESSION['id'] : null;
$post_id = isset($_POST['id']) ? (int)$_POST['id'] : null;
$post_text = isset($_POST['text']) ? (string)$_POST['text'] : null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : null;

PostForm::validate(['text' => $post_text]);

$entityManager = App::resolve(EntityManager::class);

$post = $entityManager->find(Post::class, $post_id);

authorize($user_id === $post->getAuthor()->getId());

$post->setText($post_text);

$entityManager->persist($post);
$entityManager->flush();

redirect("/?page=$page");
