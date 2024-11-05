<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $likes = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $retweets = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $comments = null;

    #[ORM\Column]
    private ?bool $state = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Tweet $tweet = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?user $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLikes(): ?string
    {
        return $this->likes;
    }

    public function setLikes(string $likes): static
    {
        $this->likes = $likes;

        return $this;
    }

    public function getRetweets(): ?string
    {
        return $this->retweets;
    }

    public function setRetweets(?string $retweets): static
    {
        $this->retweets = $retweets;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): static
    {
        $this->comments = $comments;

        return $this;
    }

    public function isState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getTweet(): ?Tweet
    {
        return $this->tweet;
    }

    public function setTweet(?Tweet $tweet): static
    {
        $this->tweet = $tweet;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }
}
