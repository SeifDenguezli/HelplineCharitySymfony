<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 * @Vich\Uploadable
 */
class Evenement
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     */
    private $eventId;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="evenements")
     * @ORM\JoinColumn(name="associationId", referencedColumnName="userId")
     * @Assert\NotBlank(message="Veuillez spécifier l'association organisatrice")
     */
    private $associationId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez spécifier la catégorie de l'évènement")
     */
    private $donCategorie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez spécifier l'objctif de l'évènement")
     */
    private $cause;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez spécifier la région de l'évènement")
     */
    private $Region;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_participants;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Veuillez spécifier la date de l'évènement")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="float")
     */
    private $montant_collecte;
    /**
     * @ORM\Column(type="string", length=1024)
     * @Assert\NotBlank(message="Veuillez spécifier une déscription de l'évènement")
     */
    private $description;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="events", fileNameProperty="coverImage")
     * @Assert\NotBlank(message="Veuillez importer une image pour votre évènement")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coverImage;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=EventUser::class, mappedBy="eventId")
     */
    private $eventUsers;

    /**
     * @ORM\OneToMany(targetEntity=EventComment::class, mappedBy="event")
     */
    private $eventComments;

    protected $captchaCode;

    public function __construct()
    {
        $this->eventUsers = new ArrayCollection();
        $this->eventComments = new ArrayCollection();
    }




    public function getEventId(): ?int
    {
        return $this->eventId;
    }

    /**
     * @param mixed $eventId
     */
    public function setEventId($eventId): void
    {
        $this->eventId = $eventId;
    }



    public function getAssociationId(): ?User
    {
        return $this->associationId;
    }

    public function setAssociationId(?User $associationId): self
    {
        $this->associationId = $associationId;

        return $this;
    }

    public function getDonCategorie(): ?string
    {
        return $this->donCategorie;
    }

    public function setDonCategorie(string $donCategorie): self
    {
        $this->donCategorie = $donCategorie;

        return $this;
    }

    public function getCause(): ?string
    {
        return $this->cause;
    }

    public function setCause(string $cause): self
    {
        $this->cause = $cause;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->Region;
    }

    public function setRegion(string $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

    public function getNumParticipants(): ?int
    {
        return $this->num_participants;
    }

    public function setNumParticipants(int $num_participants): self
    {
        $this->num_participants = $num_participants;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getMontantCollecte(): ?float
    {
        return $this->montant_collecte;
    }

    public function setMontantCollecte(float $montant_collecte): self
    {
        $this->montant_collecte = $montant_collecte;

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

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(?string $coverImage): self
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**

     * @return Collection|EventUser[]
     */
    public function getEventUsers(): Collection
    {
        return $this->eventUsers;
    }

    public function addEventUser(EventUser $eventUser): self
    {
        if (!$this->eventUsers->contains($eventUser)) {
            $this->eventUsers[] = $eventUser;
            $eventUser->setEventId($this);
        }

        return $this;
    }

    public function removeEventUser(EventUser $eventUser): self
    {
        if ($this->eventUsers->removeElement($eventUser)) {
            // set the owning side to null (unless already changed)
            if ($eventUser->getEventId() === $this) {
                $eventUser->setEventId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getCause();
    }

    /**
     * @return Collection|EventComment[]
     */
    public function getEventComments(): Collection
    {
        return $this->eventComments;
    }

    public function addEventComment(EventComment $eventComment): self
    {
        if (!$this->eventComments->contains($eventComment)) {
            $this->eventComments[] = $eventComment;
            $eventComment->setEvent($this);
        }

        return $this;
    }

    public function removeEventComment(EventComment $eventComment): self
    {
        if ($this->eventComments->removeElement($eventComment)) {
            // set the owning side to null (unless already changed)
            if ($eventComment->getEvent() === $this) {
                $eventComment->setEvent(null);
            }
        }

        return $this;
    }


    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }





}
