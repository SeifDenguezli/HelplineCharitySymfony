<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="donorId", columns={"donorId"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="productId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_approx", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixApprox;



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
     * @return int
     */
    public function getProductid(): int
    {
        return $this->productid;
    }

    /**
     * @param int $productid
     * @return Produit
     */
    public function setProductid(int $productid): Produit
    {
        $this->productid = $productid;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Produit
     */
    public function setName(string $name): Produit
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantite(): int
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     * @return Produit
     */
    public function setQuantite(int $quantite): Produit
    {
        $this->quantite = $quantite;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrixApprox(): float
    {
        return $this->prixApprox;
    }

    /**
     * @param float $prixApprox
     * @return Produit
     */
    public function setPrixApprox(float $prixApprox): Produit
    {
        $this->prixApprox = $prixApprox;
        return $this;
    }

    /**
     * @return \User
     */
    public function getDonorid(): \User
    {
        return $this->donorid;
    }

    /**
     * @param \User $donorid
     * @return Produit
     */
    public function setDonorid(\User $donorid): Produit
    {
        $this->donorid = $donorid;
        return $this;
    }


}
