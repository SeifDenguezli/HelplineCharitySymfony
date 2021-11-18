<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Posts;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\NotBlank (message="Veuillez Saisir votre commentaire")
     */
    private $commentcontent;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="postId", referencedColumnName="postId")
     * })
     */
    private $postid;



    /**
     * @return int
     */
    public function getCommentid(): int
    {
        return $this->commentid;
    }

    /**
     * @param int $commentid
     */
    public function setCommentid(int $commentid): void
    {
        $this->commentid = $commentid;
    }

    /**
     * @return string |null
     */
    public function getCommentauthor(): ?string
    {
        return $this->commentauthor;
    }

    /**
     * @param string $commentauthor
     */
    public function setCommentauthor(string $commentauthor): void
    {
        $this->commentauthor = $commentauthor;
    }

    /**
     * @return \DateTime|null
     */
    public function getCommentdate(): ?\DateTime
    {
        return $this->commentdate;
    }

    /**
     * @param \DateTime $commentdate
     */
    public function setCommentdate(\DateTime $commentdate): void
    {
        $this->commentdate = $commentdate;
    }

    /**
     * @return int|null
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
     * @return string|null
     */
    public function getCommentcontent(): ?string
    {
        return $this->commentcontent;
    }

    /**
     * @param string $commentcontent
     */
    public function setCommentcontent(string $commentcontent): void
    {
        $this->commentcontent = $commentcontent;
    }

    /**
     * @return Posts|null
     */
    public function getPostid(): ?Posts
    {
        return $this->postid;
    }

    /**
     * @param Posts $postid
     */
    public function setPostid(Posts $postid): void
    {
        ($this->postid = $postid);
    }



}
