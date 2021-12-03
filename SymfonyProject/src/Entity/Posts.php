<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vangrg\ProfanityBundle\Validator\Constraints as ProfanityAssert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable
 * @ORM\Table(name="posts")
 * @ORM\Entity(repositoryClass="App\Repository\PostsRepository")
 */
class Posts
{
    /**
     * @var int
     *
     * @ORM\Column(name="postId", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     */
    private $postid;

    /**
     * @var string
     *
     * @ORM\Column(name="postTitle", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Champ titre vide")
     */
    private $posttitle;
    /**
     * @var string
     *
     * @ORM\Column(name="postPic", type="string", length=1000, nullable=true)
     */
    private $postpic;

    /**
     * @var string
     *
     * @ORM\Column(name="postType", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Champ sujet vide")
     */
    private $posttype;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postDate", type="date", nullable=false)
     */
    private $postdate;

    /**
     * @var int
     *
     * @ORM\Column(name="likeCount", type="integer", nullable=false)
     */
    private $likecount;
    /**
     * @var int
     *
     * @ORM\Column(name="viewCount", type="integer", nullable=true)
     */
    private $viewcount;

    /**
     * @return int |null
     */
    public function getViewcount(): ?int
    {
        return $this->viewcount;
    }

    /**
     * @param int $viewcount
     */
    public function setViewcount(int $viewcount): void
    {
        $this->viewcount = $viewcount;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="postContent", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="Contenu vide")
     *
     */
    private $postcontent;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User",inversedBy="postsLiked")
     * @ORM\JoinTable(name="post_likes",
     *     joinColumns={@ORM\JoinColumn(name="post_id",referencedColumnName="postId")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_id",referencedColumnName="userId")}
     * )
     */
    private $likedBy;
    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="postid",cascade={"remove"})
     */
    private $comments;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User",inversedBy="posts")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="userId")
     */
    private $user;
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->likedBy = new ArrayCollection();
    }
    /**
     * @return Collection|comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }
    public function removeComment(Comments $comments): self
    {
        if ($this->comments->removeElement($comments)) {
            if ($comments->getPostid()=== $this) {
                $comments->setPostid(null);
            }
        }

        return $this;
    }


    /**
     * @return int | null
     */
    public function getPostid(): ?int
    {
        return $this->postid;
    }

    /**
     * @param int $postid
     */
    public function setPostid(int $postid): void
    {
        $this->postid = $postid;
    }

    /**
     * @return string| null
     */
    public function getPosttitle(): ?string
    {
        return $this->posttitle;
    }

    /**
     * @param string $posttitle
     */
    public function setPosttitle(string $posttitle): void
    {
        $this->posttitle = $posttitle;
    }

    /**
     * @return string| null
     */
    public function getPosttype(): ?string
    {
        return $this->posttype;
    }

    /**
     * @param string $posttype
     */
    public function setPosttype(string $posttype): void
    {
        $this->posttype = $posttype;
    }

    /**
     * @return \DateTime| null
     */
    public function getPostdate(): ?\DateTime
    {
        return $this->postdate;
    }

    /**
     * @param \DateTime $postdate
     */
    public function setPostdate(\DateTime $postdate): void
    {
        $this->postdate = $postdate;
    }

    /**
     * @return int| null
     */
    public function getLikecount(): ?int
    {
        return $this->likecount;
    }

    /**
     * @param int $likecount
     */
    public function setLikecount(int $likecount): void
    {
        $this->likecount = $likecount;
    }

    /**
     * @return string| null
     */
    public function getPostcontent(): ?string
    {
        return $this->postcontent;
    }

    /**
     * @param string $postcontent
     */
    public function setPostcontent(string $postcontent): void
    {
        $this->postcontent = $postcontent;
    }

    public function __toString()
    {
      return (String)$this->postid;
    }

    /**
     * @return string | null
     */
    public function getPostpic(): ?string
    {
        return $this->postpic;
    }

    /**
     * @param string | null $postpic
     */
    public function setPostpic($postpic): void
    {
        $this->postpic = $postpic;
    }

    /**
     * @return Collection
     */
    public function getLikedBy()
    {
        return $this->likedBy;
    }

    public function like(User $user){
        if($this->likedBy->contains($user)){
            return;
        }
        $this->likedBy->add($user);
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }
    /**
     * @Vich\UploadableField(mapping="posts" , fileNameProperty="postpic")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;


    public function setImageFile(File $postpic = null)
    {
        $this->imageFile = $postpic;
        if ($postpic) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($postpic)
    {
        $this->postpic = $postpic;
    }

    public function getImage()
    {
        return $this->postpic;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function addLikedBy(User $likedBy): self
    {
        if (!$this->likedBy->contains($likedBy)) {
            $this->likedBy[] = $likedBy;
        }

        return $this;
    }

    public function removeLikedBy(User $likedBy): self
    {
        $this->likedBy->removeElement($likedBy);

        return $this;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPostid($this);
        }

        return $this;
    }



}
