<?php

namespace App\Controller;

use App\Repository\EventCommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/acceuil", name="acceuil")
     */
    public function index(EventCommentRepository $eventComment): Response
    {
        $comments = $eventComment->testimonialComments();
        return $this->render('main/index.html.twig', ['comments' => $comments]);
    }
}
