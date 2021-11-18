<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *

     */
    private $shopId;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive(message="cette valeur doit etre positive")
     */
    private $donorId;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Veuillez saisir votre nom")
     *  @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
   */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotEqualTo(
     *     value = 15
     * )
     * @Assert\Positive
     * @Assert\NotBlank(message="Veuillez saisir la quantité")
     */
    private $Qte;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez saisir la couleur")
     */
    private $color;

    /**
     * @ORM\Column(type="integer")
     */
    private $cost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDonorId(): ?int
    {
        return $this->donorId;
    }

    public function setDonorId(int $donorId): self
    {
        $this->donorId = $donorId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getQte(): ?int
    {
        return $this->Qte;
    }

    public function setQte(int $Qte): self
    {
        $this->Qte = $Qte;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @param mixed $shopId
     */
    public function setShopId($shopId): void
    {
        $this->shopId = $shopId;
    }
    
}
