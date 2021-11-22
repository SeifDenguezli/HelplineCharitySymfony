<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/clikes")
 */
class CommentLikesController extends AbstractController
{
    /**
     * @Route("/clike/{postid}",name="clikes_like")
     */
    public function like(Comments $comment){
        $user = $this->getDoctrine()->getRepository(User::class)->find(133);
        $comment->like($user);
        $comment->setLikecount($comment->getLikecount()+1);
        $this->getDoctrine()->getManager()->flush();
        return new JsonResponse([
            'count'=>$comment->getLikedBy()->count()
        ]);

    }

    /**
     * @Route("/cunlike/{postid}",name="clikes_unlike")
     */
    public function unlike(Comments $comment){
        $user = $this->getDoctrine()->getRepository(User::class)->find(1);
        $comment->setLikecount($comment->getLikecount()-1);
        $comment->getLikedBy()->removeElement($user);
        $this->getDoctrine()->getManager()->flush();
        return new JsonResponse([
            'count'=>$comment->getcommentLikedBy()->count()
        ]);
    }
}