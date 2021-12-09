<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vangrg\ProfanityBundle\Validator\Constraints as ProfanityAssert;

/**
 * Posts
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity
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
     * @var string
     *
     * @ORM\Column(name="postContent", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="Contenu vide")
     *
     */
    private $postcontent;

    public function getPostid(): ?int
    {
        return $this->postid;
    }

    public function getPosttitle(): ?string
    {
        return $this->posttitle;
    }

    public function setPosttitle(string $posttitle): self
    {
        $this->posttitle = $posttitle;

        return $this;
    }

    public function getPosttype(): ?string
    {
        return $this->posttype;
    }

    public function setPosttype(string $posttype): self
    {
        $this->posttype = $posttype;

        return $this;
    }

    public function getPostdate(): ?\DateTimeInterface
    {
        return $this->postdate;
    }

    public function setPostdate(\DateTimeInterface $postdate): self
    {
        $this->postdate = $postdate;

        return $this;
    }

    public function getLikecount(): ?int
    {
        return $this->likecount;
    }

    public function setLikecount(int $likecount): self
    {
        $this->likecount = $likecount;

        return $this;
    }

    public function getPostcontent(): ?string
    {
        return $this->postcontent;
    }

    public function setPostcontent(string $postcontent): self
    {
        $this->postcontent = $postcontent;

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
     * @param string $postpic
     */
    public function setPostpic(string $postpic): void
    {
        $this->postpic = $postpic;
    }

}
