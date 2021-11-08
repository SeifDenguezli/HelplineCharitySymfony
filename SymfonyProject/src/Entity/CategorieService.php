<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieService
 *
 * @ORM\Table(name="categorie-service")
 * @ORM\Entity
 */
class CategorieService
{
    /**
     * @var int
     *
     * @ORM\Column(name="id-categorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;


}
