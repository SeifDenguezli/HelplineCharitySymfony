<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EventUser;
use App\Entity\User;
use App\Form\ParticipationType;

use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipationController extends AbstractController
{
    /**
     * @Route("/evenement/{eventId}/donate", name="participation_don")
     */
    public function joinEvent(Evenement $event, Request $request): Response
    {
        $participation = new EventUser();
        $user = $this->getDoctrine()->getRepository(User::class)->find(143);
        $participation->setUserId($user);
        $participation->setEventId($event);
        $participation->setJoinDate(new \DateTime());
        $form = $this->createForm(ParticipationType::class, $participation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($participation);
            $manager->flush();
            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('participation/donate.html.twig', [
            'event'=> $event,
            'form'=> $form->createView(),
            'user'=> $user
        ]);
    }
}
