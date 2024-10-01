<?php

namespace App\Entity;

use App\Repository\ParticipantConvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantConvRepository::class)]
class ParticipantConv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_last_seen = null;

    #[ORM\ManyToOne(inversedBy: 'participantConvs')]
    private ?participant $participants = null;

    #[ORM\ManyToOne(inversedBy: 'participantConvs')]
    private ?conv $convs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLastSeen(): ?\DateTimeImmutable
    {
        return $this->date_last_seen;
    }

    public function setDateLastSeen(\DateTimeImmutable $date_last_seen): static
    {
        $this->date_last_seen = $date_last_seen;

        return $this;
    }

    public function getParticipants(): ?participant
    {
        return $this->participants;
    }

    public function setParticipants(?participant $participants): static
    {
        $this->participants = $participants;

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
