<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Conv;
use App\Repository\ConvUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConvUserRepository::class)]
#[ApiResource]
class ConvUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_last_check = null;

    #[ORM\ManyToOne(inversedBy: 'convUsers')]
    private ?user $users = null;

    #[ORM\ManyToOne(inversedBy: 'convUsers')]
    private ?conv $convs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLastCheck(): ?\DateTimeInterface
    {
        return $this->date_last_check;
    }

    public function setDateLastCheck(?\DateTimeInterface $date_last_check): static
    {
        $this->date_last_check = $date_last_check;

        return $this;
    }

    public function getUsers(): ?user
    {
        return $this->users;
    }

    public function setUsers(?user $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getConvs(): ?conv
    {
        return $this->convs;
    }

    public function setConvs(?conv $convs): static
    {
        $this->convs = $convs;

        return $this;
    }
}