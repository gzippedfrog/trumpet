<?php

namespace Core;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
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