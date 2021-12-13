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
     */
    private $description;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="donorId", referencedColumnName="userId")
     * })
     */
    private $donorid;

    public function getServiceid(): ?int
    {
        return $this->serviceid;
    }


    public function getTypeservice(): ?string
    {
        return $this->typeservice;
    }


    public function setTypeservice(string $typeservice): self
    {
        $this->typeservice = $typeservice;

        return $this;
    }


    public function getLieu(): ?string
    {
        return $this->lieu;
    }


    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDatedisponibilite(): ?\DateTimeInterface
    {
        return $this->datedisponibilite;
    }


    public function setDatedisponibilite(\DateTimeInterface $datedisponibilite): self
    {
        $this->datedisponibilite = $datedisponibilite;

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


    public function getDonorid(): ?User
    {
        return $this->donorid;
    }


    public function setDonorid(?User $donorid): self
    {
        $this->donorid = $donorid;

        return $this;
    }



}
