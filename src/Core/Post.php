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
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private string $text;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'createdPosts')]
    private User $author;

    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'replies')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id')]
    private ?Post $parent = null;

    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'parent')]
    private Collection $replies;

    #[ORM\Column(type: 'string')]
    private string|null $image;

    #[ORM\JoinTable(name: 'likes')]
    #[ORM\JoinColumn(name: 'post_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: User::class)]
    private Collection $likedBy;

    public function __construct()
    {
        $this->replies = new ArrayCollection();
        $this->likedBy = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $user
     * @return void
     */
    public function setAuthor(User $user): void
    {
        $user->addPost($this);
        $this->author = $user;
    }

    /**
     * @return Post|null
     */
    public function getParent(): ?Post
    {
        return $this->parent;
    }

    /**
     * @param Post $post
     * @return void
     */
    public function setParent(Post $post): void
    {
        $post->addReply($this);
        $this->parent = $post;
    }

    public function addReply(Post $post): void
    {
        $this->replies[] = $post;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return Collection
     */
    public function getLikedBy(): Collection
    {
        return $this->likedBy;
    }

    /**
     * @return Collection
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    /**
     * @param User $user
     * @return void
     */
    public function addLike(User $user): void
    {
        $this->likedBy[] = $user;
    }

    /**
     * @param int $user_id
     * @return void
     */
    public function removeLike(int $user_id): void
    {
        $user = $this->likedBy->findFirst(fn($key, $user) => $user->getId() === $user_id);
        $this->likedBy->removeElement($user);
    }

    /**
     * @param int $user_id
     * @return bool
     */
    public function isLikedBy(int $user_id): bool
    {
        return $this->likedBy->exists(fn($key, $user) => $user->getId() == $user_id);
    }
}

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