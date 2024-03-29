<?php

namespace App\Controller;
use App\Entity\Posts;
use App\Entity\User;
use App\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/clikes")
 */
class CommentLikesController extends AbstractController
{
    /**
     * @Route("/clike/{commentid}",name="clikes_like")
     * @IsGranted("ROLE_USER")
     */
    public function like(Comments $comment){
        $user = $this->getUser();
        $comment1 = $this->getDoctrine()->getRepository(Comments::class)->find($comment);
        $comment1->like($user);
        $comment1->setLikecount($comment1->getLikecount()+1);
        $this->getDoctrine()->getManager()->flush();
        return new JsonResponse([
            'count'=>$comment1->getLikedBy()->count()
        ]);

    }

    /**
     * @Route("/cunlike/{commentid}",name="clikes_unlike")
     */
        public function unlike(Comments $comment) {
            $user = $this->getUser();
            $comment->setLikecount($comment->getLikecount()-1);
            $comment->getLikedBy()->removeElement($user);
            $this->getDoctrine()->getManager()->flush();
            return new JsonResponse([
                'count'=>$comment->getLikedBy()->count()
            ]);
        }


}