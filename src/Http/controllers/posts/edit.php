<?php

use Core\App;
use Core\Paginator;
use Core\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

$per_page = 4;
$page = $_GET['page'] ?? null;
$user_id = $_SESSION['id'] ?? null;
$edit_id = $_GET['id'] ?? null;

/** @var EntityManager $entityManager */
$entityManager = App::resolve(EntityManager::class);

$post_to_edit = $entityManager->find(Post::class, $edit_id);

authorize($user_id === $post_to_edit->author->id);

$posts_total = $entityManager->getRepository(Post::class)->count(['parent' => null]);
$pages_total = ceil($posts_total / $per_page);

if ($page < 1 || $page > $pages_total) {
    $_GET['page'] = 1;
    redirect('/?' . http_build_query($_GET));
}

$dql = /** @lang DQL */
    'SELECT p FROM ' . Post::class . ' p WHERE p.parent IS NULL ORDER BY p.id DESC';

$query = $entityManager->createQuery($dql)
    ->setFirstResult(($page - 1) * $per_page)
    ->setMaxResults($per_page);

$posts = new DoctrinePaginator($query, $fetchJoinCollection = true);

$prevPageUrl = Paginator::getPrevPageUrl($_GET);
$nextPageUrl = Paginator::getNextPageUrl($_GET, $pages_total);

view(
    'index',
    compact(['posts', 'post_to_edit', 'page', 'user_id', 'prevPageUrl', 'nextPageUrl'])
);
