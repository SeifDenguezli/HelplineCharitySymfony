<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Don
 *
 * @ORM\Table(name="don")
 * @ORM\Entity
 */
class Don
{
    /**
     * @var int
     *
     * @ORM\Column(name="donId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $donid;

    /**
     * @var int
     *
     * @ORM\Column(name="donorId", type="integer", nullable=false)
     */
    private $donorid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="eventId", type="integer", nullable=true)
     */
    private $eventid;

    /**
     * @var string
     *
     * @ORM\Column(name="donationDate", type="string", length=30, nullable=false)
     */
    private $donationdate;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="Categorie", type="string", length=60, nullable=false)
     */
    private $categorie;

    public function getDonid(): ?int
    {
        return $this->donid;
    }

    public function getDonorid(): ?int
    {
        return $this->donorid;
    }

    public function setDonorid(int $donorid): self
    {
        $this->donorid = $donorid;

        return $this;
    }

    public function getEventid(): ?int
    {
        return $this->eventid;
    }

    public function setEventid(?int $eventid): self
    {
        $this->eventid = $eventid;

        return $this;
    }

    public function getDonationdate(): ?string
    {
        return $this->donationdate;
    }

    public function setDonationdate(string $donationdate): self
    {
        $this->donationdate = $donationdate;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }


}
