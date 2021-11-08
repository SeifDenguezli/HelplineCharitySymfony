<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Don
 *
 * @ORM\Table(name="don", indexes={@ORM\Index(name="eventId", columns={"eventId"}), @ORM\Index(name="donorId", columns={"donorId"})})
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

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="donorId", referencedColumnName="userId")
     * })
     */
    private $donorid;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eventId", referencedColumnName="eventId")
     * })
     */
    private $eventid;


}
