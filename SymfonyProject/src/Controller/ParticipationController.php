<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EventUser;
use App\Entity\User;
use App\Form\ParticipationType;

use App\Repository\EvenementRepository;
use App\Repository\EventUserRepository;
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
        $user = $this->getUser();
        $participation->setUserId($user);
        $participation->setEventId($event);
        $participation->setJoinDate(new \DateTime());
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            //Recuperer le montant du don à partir du formulaire de don
            $amount = $form["amount"]->getData();

            $manager = $this->getDoctrine()->getManager();

            /*
             * Cette Partie consiste à recuperer l'evenement de modifier le montant colecté total et le num de participants
             * chaque fois un don est lancé
             */
            $ev = $manager->getRepository(Evenement::class)->find($event->getEventId());
            $ev->setMontantCollecte($event->getMontantCollecte() + $amount);
            $ev->setNumParticipants($ev->getNumParticipants() + 1);
            ///////////////////////////////////

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
