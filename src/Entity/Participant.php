<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_last_check = null;

    #[ORM\ManyToOne(inversedBy: 'participants')]
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'participants')]
    private ?ParticipantConv $participantConv = null;

    /**
     * @var Collection<int, ParticipantConv>
     */
    #[ORM\OneToMany(targetEntity: ParticipantConv::class, mappedBy: 'participants')]
    private Collection $participantConvs;

    public function __construct()
    {
        $this->participantConvs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLastCheck(): ?\DateTimeInterface
    {
        return $this->date_last_check;
    }

    public function setDateLastCheck(\DateTimeInterface $date_last_check): static
    {
        $this->date_last_check = $date_last_check;

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

    public function getParticipantConv(): ?ParticipantConv
    {
        return $this->participantConv;
    }

    public function setParticipantConv(?ParticipantConv $participantConv): static
    {
        $this->participantConv = $participantConv;

        return $this;
    }

    /**
     * @return Collection<int, ParticipantConv>
     */
    public function getParticipantConvs(): Collection
    {
        return $this->participantConvs;
    }

    public function addParticipantConv(ParticipantConv $participantConv): static
    {
        if (!$this->participantConvs->contains($participantConv)) {
            $this->participantConvs->add($participantConv);
            $participantConv->setParticipants($this);
        }

        return $this;
    }

    public function removeParticipantConv(ParticipantConv $participantConv): static
    {
        if ($this->participantConvs->removeElement($participantConv)) {
            // set the owning side to null (unless already changed)
            if ($participantConv->getParticipants() === $this) {
                $participantConv->setParticipants(null);
            }
        }

        return $this;
    }
}