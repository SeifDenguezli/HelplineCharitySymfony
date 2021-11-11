<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $eventId;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="evenements")
     * @ORM\JoinColumn(name="associationId", referencedColumnName="userId")
     */
    private $associationId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $donCategorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cause;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Region;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_participants;

    /**
     * @ORM\Column(type="date")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="float")
     */
    private $montant_collecte;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    private $description;




    public function getEventId(): ?int
    {
        return $this->eventId;
    }

    /**
     * @param mixed $eventId
     */
    public function setEventId($eventId): void
    {
        $this->eventId = $eventId;
    }



    public function getAssociationId(): ?User
    {
        return $this->associationId;
    }

    public function setAssociationId(?User $associationId): self
    {
        $this->associationId = $associationId;

        return $this;
    }

    public function getDonCategorie(): ?string
    {
        return $this->donCategorie;
    }

    public function setDonCategorie(string $donCategorie): self
    {
        $this->donCategorie = $donCategorie;

        return $this;
    }

    public function getCause(): ?string
    {
        return $this->cause;
    }

    public function setCause(string $cause): self
    {
        $this->cause = $cause;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->Region;
    }

    public function setRegion(string $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

    public function getNumParticipants(): ?int
    {
        return $this->num_participants;
    }

    public function setNumParticipants(int $num_participants): self
    {
        $this->num_participants = $num_participants;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getMontantCollecte(): ?float
    {
        return $this->montant_collecte;
    }

    public function setMontantCollecte(float $montant_collecte): self
    {
        $this->montant_collecte = $montant_collecte;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
