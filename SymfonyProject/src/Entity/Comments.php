<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToMany(targetEntity="App\Entity\User",inversedBy="commentsLiked")
     * @ORM\JoinTable(name="allcomments_likes",
     *     joinColumns={@ORM\JoinColumn(name="comment_id",referencedColumnName="commentId")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_id",referencedColumnName="userId")}
     * )
     */
    private $likedBy;

    public function __construct()
    {
        $this->likedBy = new ArrayCollection();
    }

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
     * @ORM\ManyToOne(targetEntity="Posts",inversedBy="comments",cascade={"remove"})
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

}
