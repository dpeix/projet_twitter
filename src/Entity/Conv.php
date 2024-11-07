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

    #[ORM\Column]
    private ?\DateTimeImmutable $date_last_message = null;

    /**
     * @var Collection<int, ConvUser>
     */
    #[ORM\OneToMany(targetEntity: ConvUser::class, mappedBy: 'convs')]
    private Collection $convUsers;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->convUsers = new ArrayCollection();
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

    public function getDateLastMessage(): ?\DateTimeImmutable
    {
        return $this->date_last_message;
    }

    public function setDateLastMessage(\DateTimeImmutable $date_last_message): static
    {
        $this->date_last_message = $date_last_message;

        return $this;
    }

    /**
     * @return Collection<int, ConvUser>
     */
    public function getConvUsers(): Collection
    {
        return $this->convUsers;
    }

    public function addConvUser(ConvUser $convUser): static
    {
        if (!$this->convUsers->contains($convUser)) {
            $this->convUsers->add($convUser);
            $convUser->setConvs($this);
        }

        return $this;
    }

    public function removeConvUser(ConvUser $convUser): static
    {
        if ($this->convUsers->removeElement($convUser)) {
            // set the owning side to null (unless already changed)
            if ($convUser->getConvs() === $this) {
                $convUser->setConvs(null);
            }
        }

        return $this;
    }
}
