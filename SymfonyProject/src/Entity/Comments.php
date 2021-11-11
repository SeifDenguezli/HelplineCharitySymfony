<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="comments", indexes={@ORM\Index(name="postId", columns={"postId"})})
 * @ORM\Entity
 */
class Comments
{
    /**
     * @var int
     *
     * @ORM\Column(name="commentId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $commentid;

    /**
     * @var string
     *
     * @ORM\Column(name="commentAuthor", type="string", length=255, nullable=false)
     */
    private $commentauthor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="commentDate", type="date", nullable=false)
     */
    private $commentdate;

    /**
     * @var int
     *
     * @ORM\Column(name="likeCount", type="integer", nullable=false)
     */
    private $likecount;

    /**
     * @var string
     *
     * @ORM\Column(name="commentContent", type="text", length=65535, nullable=false)
     */
    private $commentcontent;

    /**
     * @var \Posts
     *
     * @ORM\ManyToOne(targetEntity="Posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="postId", referencedColumnName="postId")
     * })
     */
    private $postid;

    public function getCommentid(): ?int
    {
        return $this->commentid;
    }

    public function getCommentauthor(): ?string
    {
        return $this->commentauthor;
    }

    public function setCommentauthor(string $commentauthor): self
    {
        $this->commentauthor = $commentauthor;

        return $this;
    }

    public function getCommentdate(): ?\DateTimeInterface
    {
        return $this->commentdate;
    }

    public function setCommentdate(\DateTimeInterface $commentdate): self
    {
        $this->commentdate = $commentdate;

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

    public function getCommentcontent(): ?string
    {
        return $this->commentcontent;
    }

    public function setCommentcontent(string $commentcontent): self
    {
        $this->commentcontent = $commentcontent;

        return $this;
    }

    public function getPostid(): ?Posts
    {
        return $this->postid;
    }

    public function setPostid(?Posts $postid): self
    {
        $this->postid = $postid;

        return $this;
    }


}
