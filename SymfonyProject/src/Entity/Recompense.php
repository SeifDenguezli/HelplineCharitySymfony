<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recompense
 *
 * @ORM\Table(name="recompense", indexes={@ORM\Index(name="donorId", columns={"donorId"})})
 * @ORM\Entity
 */
class Recompense
{
    /**
     * @var int
     *
     * @ORM\Column(name="recompenseId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $recompenseid;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrePoints", type="integer", nullable=false)
     */
    private $nbrepoints;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="donorId", referencedColumnName="userId")
     * })
     */
    private $donorid;

    public function getRecompenseid(): ?int
    {
        return $this->recompenseid;
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
