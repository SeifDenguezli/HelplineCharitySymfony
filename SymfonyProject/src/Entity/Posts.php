<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="postId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $postid;

    /**
     * @var string
     *
     * @ORM\Column(name="postTitle", type="string", length=255, nullable=false)
     */
    private $posttitle;

    /**
     * @var string
     *
     * @ORM\Column(name="postType", type="string", length=255, nullable=false)
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


}
