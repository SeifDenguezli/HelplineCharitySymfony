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


}
