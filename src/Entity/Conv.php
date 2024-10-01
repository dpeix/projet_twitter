<?php

namespace App\Entity;

use App\Repository\ConvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConvRepository::class)]
class Conv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'conv')]
    private Collection $messages;

    #[ORM\ManyToOne(inversedBy: 'convs')]
    private ?ParticipantConv $participantConv = null;

    /**
     * @var Collection<int, ParticipantConv>
     */
    #[ORM\OneToMany(targetEntity: ParticipantConv::class, mappedBy: 'convs')]
    private Collection $participantConvs;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_last_message = null;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->participantConvs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setConv($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getConv() === $this) {
                $message->setConv(null);
            }
        }

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
            $participantConv->setConvs($this);
        }

        return $this;
    }

    public function removeParticipantConv(ParticipantConv $participantConv): static
    {
        if ($this->participantConvs->removeElement($participantConv)) {
            // set the owning side to null (unless already changed)
            if ($participantConv->getConvs() === $this) {
                $participantConv->setConvs(null);
            }
        }

        return $this;
    }

    public function getDateLastMessage(): ?\DateTimeImmutable
    {
        return $this->date_last_message;
    }

    public function setDateLastMessage(\DateTimeImmutable $date_last_message): static
    {
        $this->date_last_message = $date_last_message;

        return $this;
    }
}
