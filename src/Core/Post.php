<?php

namespace Core;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Pagination\Paginator;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\Table(name: 'posts')]
class Post
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    public int|null $id = null;

    #[ORM\Column(type: 'string')]
    public string $text;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'createdPosts')]
    public User $author;

    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'replies')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id')]
    public Post|null $parent = null;

    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'parent')]
    public Collection $replies;

    #[ORM\Column(type: 'string')]
    public string|null $image;

    #[ORM\JoinTable(name: 'likes')]
    #[ORM\JoinColumn(name: 'post_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: User::class)]
    public Collection $likedBy;

    public function __construct()
    {
        $this->replies = new ArrayCollection();
        $this->likedBy = new ArrayCollection();
    }

    public function isLikedBy($user_id)
    {
        return $this->likedBy->exists(fn($i, $user) => $user->id == $user_id);
    }

    public function removeLike($user_id)
    {
        $user = $this->likedBy->findFirst(fn($key, $user) => $user->id === $user_id);
        $this->likedBy->removeElement($user);
    }

    public function addLike($user)
    {
        $this->likedBy[] = $user;
    }
}

class PostRepository extends EntityRepository
{
    public function getLatestPostsPaginator($page = 1, $per_page = 4)
    {
        $dql = /** @lang DQL */
            'SELECT p FROM ' . Post::class . ' p WHERE p.parent IS NULL ORDER BY p.id DESC';

        $query = $this->_em->createQuery($dql)
            ->setFirstResult(($page - 1) * $per_page)
            ->setMaxResults($per_page);

        return new Paginator($query);
    }

    public function getTotalPages($per_page)
    {
        $posts_total = $this->_em->getRepository(Post::class)->count(['parent' => null]);

        return ceil($posts_total / $per_page);
    }
}