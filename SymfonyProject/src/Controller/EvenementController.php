<?php

namespace App\Controller;

use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EvenementController extends AbstractController
{


    /**
     * @Route("/eventList", name="eventList")
     */
    public function eventsList(): Response
    {
        $evenements = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->findAll();

        return $this->render('evenement/eventList.html.twig', [
            'evenements' => $evenements,
        ]);

    }
}
