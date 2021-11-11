<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="Veuillez donnez le titre du post")
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
     * @Assert\NotBlank(message="Veuillez donnez le sujet du post")
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
     * @Assert\NotBlank(message="Vous ne pouvez pas creer un post vide")
     */
    private $postcontent;

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
