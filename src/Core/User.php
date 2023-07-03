<?php

namespace Core;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private string $username;

    #[ORM\Column(type: 'string')]
    private string $password_hash;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Post::class)]
    private Collection $createdPosts;

    public function __construct()
    {
        $this->createdPosts = new ArrayCollection();
    }

    public function addPost(Post $post): void
    {
        $this->createdPosts[] = $post;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }

    /**
     * @param string $password_hash
     */
    public function setPasswordHash(string $password_hash): void
    {
        $this->password_hash = $password_hash;
    }

    /**
     * @return Collection
     */
    public function getCreatedPosts(): Collection
    {
        return $this->createdPosts;
    }

    /**
     * @param Collection $createdPosts
     */
    public function setCreatedPosts(Collection $createdPosts): void
    {
        $this->createdPosts = $createdPosts;
    }
}