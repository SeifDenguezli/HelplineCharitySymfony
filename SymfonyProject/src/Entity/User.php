<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @Vich\Uploadable
 * @UniqueEntity(
 *     fields={"mail"},
 *     message="L'email que vous avez indiqué est déja utilisé"
 * )
 */
class User implements UserInterface
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
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;
    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @Vich\UploadableField(mapping="users", fileNameProperty="photo")
     * @var File
     */
    private $imageFile;
    public function getImageFile()
    {
        return $this->imageFile;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères")
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

    /**
     * @return int
     */
    public function getUserid(): ?int
    {
        return $this->userid;
    }

    /**
     * @param int $userid
     */
    public function setUserid(?int $userid): void
    {
        $this->userid = $userid;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string|null $photo
     */
    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getGouvernorat(): ?string
    {
        return $this->gouvernorat;
    }

    /**
     * @param string $gouvernorat
     */
    public function setGouvernorat(?string $gouvernorat): void
    {
        $this->gouvernorat = $gouvernorat;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(?string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(?string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return float|null
     */
    public function getMontantDonne(): ?float
    {
        return $this->montantDonne;
    }

    /**
     * @param float|null $montantDonne
     */
    public function setMontantDonne(?float $montantDonne): void
    {
        $this->montantDonne = $montantDonne;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventid()
    {
        return $this->eventid;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $eventid
     */
    public function setEventid($eventid): void
    {
        $this->eventid = $eventid;
    }

    public function eraseCredentials(){}
    public function getSalt(){}
    public function getRoles(){
    return ['ROLE_USER'];
}



}
