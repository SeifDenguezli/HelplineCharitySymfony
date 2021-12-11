<?php

namespace App\Controller;
use App\Entity\Posts;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @Route("/likes")
 */
class LikesController extends Controller
{
    /**
     * @Route("/like/{postid}",name="likes_like")
     * @IsGranted("ROLE_USER")
     */
    public function like(Posts $post){
        $user = $this->getUser();
      $post->like($user);
      $post->setLikecount($post->getLikecount()+1);
      $this->getDoctrine()->getManager()->flush();
      return new JsonResponse([
          'count'=>$post->getLikedBy()->count()
      ]);
    }

    /**
     * @Route("/unlike/{postid}",name="likes_unlike")
     * @IsGranted("ROLE_USER")
     */
    public function unlike(Posts $post){
        $user = $this->getUser();
        $post->setLikecount($post->getLikecount()-1);
        $post->getLikedBy()->removeElement($user);
        $this->getDoctrine()->getManager()->flush();
        return new JsonResponse([
            'count'=>$post->getLikedBy()->count()
        ]);
    }

}