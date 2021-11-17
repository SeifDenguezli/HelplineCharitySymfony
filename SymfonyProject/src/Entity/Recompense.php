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
    public function getRecompenseid(): int
    {
        return $this->recompenseid;
    }

    /**
     * @param int $recompenseid
     */
    public function setRecompenseid(int $recompenseid): void
    {
        $this->recompenseid = $recompenseid;
    }

    /**
     * @return int |null
     */
    public function getNbrepoints(): ?int
    {
        return $this->nbrepoints;
    }

    /**
     * @param int $nbrepoints
     */
    public function setNbrepoints(int $nbrepoints): void
    {
        $this->nbrepoints = $nbrepoints;
    }

    /**
     * @return User |null
     */
    public function getDonorid(): ?User
    {
        return $this->donorid;
    }

    /**
     * @param User $donorid
     */
    public function setDonorid(User $donorid): void
    {
        $this->donorid = $donorid;
    }



}
