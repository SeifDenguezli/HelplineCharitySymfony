<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recu
 *
 * @ORM\Table(name="recu", indexes={@ORM\Index(name="donationId", columns={"donationId"})})
 * @ORM\Entity
 */
class Recu
{
    /**
     * @var int
     *
     * @ORM\Column(name="recuId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $recuid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePayement", type="date", nullable=false)
     */
    private $datepayement;

    /**
     * @var \Don
     *
     * @ORM\ManyToOne(targetEntity="Don")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="donationId", referencedColumnName="donId")
     * })
     */
    private $donationid;

    public function getRecuid(): ?int
    {
        return $this->recuid;
    }

    public function getDatepayement(): ?\DateTimeInterface
    {
        return $this->datepayement;
    }

    public function setDatepayement(\DateTimeInterface $datepayement): self
    {
        $this->datepayement = $datepayement;

        return $this;
    }

    public function getDonationid(): ?Don
    {
        return $this->donationid;
    }

    public function setDonationid(?Don $donationid): self
    {
        $this->donationid = $donationid;

        return $this;
    }


}
