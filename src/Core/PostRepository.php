<?php

namespace Core;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PostRepository extends EntityRepository
{
    /**
     * @param int $page
     * @param int $per_page
     * @return Paginator
     */
    public function getLatestPostsPaginator(int $page = 1, int $per_page = 4): Paginator
    {
        $dql = /** @lang DQL */
            'SELECT p FROM ' . Post::class . ' p WHERE p.parent IS NULL ORDER BY p.id DESC';

        $query = $this->_em->createQuery($dql)
            ->setFirstResult(($page - 1) * $per_page)
            ->setMaxResults($per_page);

        return new Paginator($query);
    }

    /**
     * @param int $per_page
     * @return int
     */
    public function getTotalPages(int $per_page): int
    {
        $posts_total = $this->_em->getRepository(Post::class)->count(['parent' => null]);

        return ceil($posts_total / $per_page);
    }
}