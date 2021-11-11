<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\User;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/", name="evenement_index", methods={"GET"})
     */
    public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/getFakeData", name="getFakeData")
     */
    public function getFakeData(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $faker = Factory::create('FR-fr');

        $users = [];

        //Generation Users
        for($i=1; $i <= 10; $i++) {
            $user = new User();
            $user->setName($faker->name);
            $user->setPassword($faker->password);
            $user->setCity($faker->city);
            $user->setGouvernorat($faker->state);
            $user->setPhone($faker->phoneNumber);
            $user->setMail($faker->email);
            $user->setRole($faker->state);
            $user->setMontantDonne($faker->randomFloat());
            $manager->persist($user);
            $users[] = $user;

        }

        //Generation Evenements
        for($i=1; $i <= 10; $i++) {

            $donCateg = $faker->sentence;
            $cause = $faker->sentence;
            $region = $faker->country;
            $participants = mt_rand(20, 200);
            $dateCreation = $faker->dateTime;
            $montantCollecte = $faker->randomFloat();
            $description = $faker->sentence;
            $user = $users[mt_rand(0,count($users)-1)];

            $event = new Evenement();

            $event->setDonCategorie($donCateg);
            $event->setCause($cause);
            $event->setRegion($region);

            $event->setNumParticipants($participants);
            $event->setDateCreation($dateCreation);
            $event->setMontantCollecte($montantCollecte);
            $event->setDescription($description);
            $event->setAssociationId($user);

            $manager->persist($event);
            $manager->flush();
        }

        return $this->redirectToRoute('evenement_index', []);
    }

    /**
     * @Route("/{eventId}", name="evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/{eventId}/edit", name="evenement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenement $evenement): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{eventId}", name="evenement_delete", methods={"POST"})
     */
    public function delete(Request $request, Evenement $evenement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getEventId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evenement_index', [], Response::HTTP_SEE_OTHER);
    }


}
