<?php

namespace App\Controller;

use App\Repository\EventCommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class MainController extends AbstractController
{
    /**
     * @Route("/acceuil", name="acceuil")
     * @IsGranted("ROLE_USER")
     */
    public function index(EventCommentRepository $eventComment): Response
    {
        $comments = $eventComment->testimonialComments();
        return $this->render('main/index.html.twig', ['comments' => $comments]);
    }
}
