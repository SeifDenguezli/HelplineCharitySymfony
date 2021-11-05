<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="gouvernorat", type="string", length=255, nullable=false)
     */
    private $gouvernorat;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=false)
     */
    private $role;

    /**
     * @var float|null
     *
     * @ORM\Column(name="montant_donne", type="float", precision=10, scale=0, nullable=true)
     */
    private $montantDonne;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Evenement", inversedBy="userid")
     * @ORM\JoinTable(name="event_user",
     *   joinColumns={
     *     @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="eventId", referencedColumnName="eventId")
     *   }
     * )
     */
    private $eventid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventid = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
