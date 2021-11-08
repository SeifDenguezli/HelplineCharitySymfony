<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement", indexes={@ORM\Index(name="associationId", columns={"associationId"})})
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="eventId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $eventid;

    /**
     * @var string
     *
     * @ORM\Column(name="donCategorie", type="string", length=255, nullable=false)
     */
    private $doncategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="cause", type="string", length=255, nullable=false)
     */
    private $cause;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Region", type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @var int
     *
     * @ORM\Column(name="num_participants", type="integer", nullable=false)
     */
    private $numParticipants;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date", nullable=false)
     */
    private $dateCreation;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_collecte", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantCollecte;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1024, nullable=false)
     */
    private $description;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="associationId", referencedColumnName="userId")
     * })
     */
    private $associationid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="eventid")
     */
    private $userid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getEventid(): int
    {
        return $this->eventid;
    }

    /**
     * @param int $eventid
     */
    public function setEventid(int $eventid): void
    {
        $this->eventid = $eventid;
    }

    /**
     * @return string
     */
    public function getDoncategorie(): string
    {
        return $this->doncategorie;
    }

    /**
     * @param string $doncategorie
     */
    public function setDoncategorie(string $doncategorie): void
    {
        $this->doncategorie = $doncategorie;
    }

    /**
     * @return string
     */
    public function getCause(): string
    {
        return $this->cause;
    }

    /**
     * @param string $cause
     */
    public function setCause(string $cause): void
    {
        $this->cause = $cause;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string|null $region
     */
    public function setRegion(?string $region): void
    {
        $this->region = $region;
    }

    /**
     * @return int
     */
    public function getNumParticipants(): int
    {
        return $this->numParticipants;
    }

    /**
     * @param int $numParticipants
     */
    public function setNumParticipants(int $numParticipants): void
    {
        $this->numParticipants = $numParticipants;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }

    /**
     * @param \DateTime $dateCreation
     */
    public function setDateCreation(\DateTime $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return float
     */
    public function getMontantCollecte(): float
    {
        return $this->montantCollecte;
    }

    /**
     * @param float $montantCollecte
     */
    public function setMontantCollecte(float $montantCollecte): void
    {
        $this->montantCollecte = $montantCollecte;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }



}
