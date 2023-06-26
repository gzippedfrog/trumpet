<?php

use Core\App;
use Core\Post;
use Doctrine\ORM\EntityManager;
use Http\Forms\PostForm;

$page = $_GET['page'];
$post_id = $_POST['id'];
$post_text = $_POST['text'];
$user_id = $_SESSION['id'];

PostForm::validate(['text' => $post_text]);

/** @var EntityManager $entityManager */
$entityManager = App::resolve(EntityManager::class);

$post = $entityManager->find(Post::class, $post_id);

authorize($user_id === $post->author->id);

$post->text = $post_text;

$entityManager->persist($post);
$entityManager->flush();

redirect("/?page=$page");
