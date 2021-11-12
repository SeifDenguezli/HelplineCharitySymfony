<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="typeService", type="string", length=255, nullable=false)
     */
    private $typeservice;

    /**
     * @var string
     *
     * @ORM\Column(name="Lieu", type="string", length=255, nullable=false)
     */
    private $lieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDisponibilite", type="date", nullable=false)
     */
    private $datedisponibilite;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
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
     * @return int|null
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
     * @return string|null
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
     * @return string|null
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
     * @return \DateTime|null
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
     * @return User|null
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
    /**
     * @return string|null
     */
    public function getdescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setdescription(?string $description): void
    {
        $this->lieu = $description;
    }


}
