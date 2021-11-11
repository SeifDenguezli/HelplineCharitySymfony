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


}
