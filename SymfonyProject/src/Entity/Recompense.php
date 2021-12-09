<?php

namespace App\Entity;

use App\Repository\RecompenseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecompenseRepository::class)
 */
class Recompense
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $recompenseid;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrepoints;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recompenses")
     * @ORM\JoinColumn(name="donorId", referencedColumnName="userId")
     */
    private $donorid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecompenseid(): ?int
    {
        return $this->recompenseid;
    }

    public function setRecompenseid(int $recompenseid): self
    {
        $this->recompenseid = $recompenseid;

        return $this;
    }

    public function getNbrepoints(): ?int
    {
        return $this->nbrepoints;
    }

    public function setNbrepoints(int $nbrepoints): self
    {
        $this->nbrepoints = $nbrepoints;

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
