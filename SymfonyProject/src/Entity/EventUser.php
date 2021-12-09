<?php

namespace App\Entity;

use App\Repository\EventUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EventUserRepository::class)
 */
class EventUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="eventUsers")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId", nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity=Evenement::class, inversedBy="eventUsers")
     * @ORM\JoinColumn(name="eventId", referencedColumnName="event_id", nullable=false)
     */
    private $eventId;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $joinDate;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\NotBlank(message="Veuillez spécifier un montant  de don")
     */
    private $amount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getEventId(): ?Evenement
    {
        return $this->eventId;
    }

    public function setEventId(?Evenement $eventId): self
    {
        $this->eventId = $eventId;

        return $this;
    }

    public function getJoinDate(): ?\DateTimeInterface
    {
        return $this->joinDate;
    }

    public function setJoinDate(?\DateTimeInterface $joinDate): self
    {
        $this->joinDate = $joinDate;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
