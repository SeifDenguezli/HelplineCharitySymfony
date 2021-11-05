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

}
