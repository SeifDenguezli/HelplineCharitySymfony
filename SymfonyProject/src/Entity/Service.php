<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="donorId", columns={"donorId"})})
 * @ORM\Entity
 */
class Service
{
    /**
     * @var int
     *
     * @ORM\Column(name="serviceId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $serviceid;

    /**
     * @var string
     *
     * @ORM\Column(name="TypeService", type="string", length=255, nullable=false)
     */
    private $typeservice;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Veuillez spécifier le lieu")
     */
    private $lieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDisponibilite", type="date", nullable=false)
     */
    private $datedisponibilite;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Veuillez spécifier une description")
     */
    private $description;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="donorId", referencedColumnName="userId")
     * })
     */
    private $donorid;

    /**
     * @return int
     */
    public function getServiceid(): ?int
    {
        return $this->serviceid;
    }

    /**
     * @param int $serviceid
     */
    public function setServiceid(?int $serviceid): void
    {
        $this->serviceid = $serviceid;
    }

    /**
     * @return string
     */
    public function getTypeservice(): ?string
    {
        return $this->typeservice;
    }

    /**
     * @param string $typeservice
     */
    public function setTypeservice(?string $typeservice): void
    {
        $this->typeservice = $typeservice;
    }

    /**
     * @return string
     */
    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu(?string $lieu): void
    {
        $this->lieu = $lieu;
    }

    /**
     * @return \DateTime
     */
    public function getDatedisponibilite(): ?\DateTime
    {
        return $this->datedisponibilite;
    }

    /**
     * @param \DateTime $datedisponibilite
     */
    public function setDatedisponibilite(?\DateTime $datedisponibilite): void
    {
        $this->datedisponibilite = $datedisponibilite;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return User
     */
    public function getDonorid(): ?User
    {
        return $this->donorid;
    }

    /**
     * @param User $donorid
     */
    public function setDonorid(?User $donorid): void
    {
        $this->donorid = $donorid;
    }




}
