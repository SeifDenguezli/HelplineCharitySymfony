<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EventUser;
use App\Entity\User;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Faker\Factory;
use Knp\Component\Pager\PaginatorInterface;
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
    public function index(EvenementRepository $evenementRepository, Request $request, PaginatorInterface $paginator): Response
    {

        $donnees = $evenementRepository->findAll();

        $evenements = $paginator->paginate(
            $donnees,
            $request->query->getInt('page',1),
            4

        );


        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }



    /**
     * @Route("/new", name="evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evenement = new Evenement();
        $evenement->setMontantCollecte(0);
        $evenement->setNumParticipants(0);
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
        $genres = ['male', 'female'];

        //Generation Users
        for($i=1; $i <= 10; $i++) {
            $user = new User();
            $genre = $faker->randomElement($genres);

            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1,99) . '.jpg';

            if ($genre == 'male') $picture = $picture . 'men/' . $pictureId;
            else $picture = $picture . 'women/' . $pictureId;

            $user->setName($faker->name($genre));
            $user->setPassword($faker->password);
            $user->setCity($faker->city);
            $user->setGouvernorat($faker->state);
            $user->setPhone($faker->phoneNumber);
            $user->setMail($faker->email);
            $user->setRole($faker->state);
            $user->setMontantDonne($faker->randomFloat());
            $user->setPhoto($picture);
            $manager->persist($user);
            $users[] = $user;

        }

        //Generation Evenements
        for($i=1; $i <= 10; $i++) {

            $donCateg = $faker->sentence(1);
            $cause = $faker->sentence();
            $region = $faker->country;
            $participants = mt_rand(20, 200);
            $dateCreation = $faker->dateTime;
            $montantCollecte = $faker->randomFloat(2, 0, 10000);
            $description = $faker->sentence;
            $coverImage = $faker->imageUrl(600,400);
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
            $event->setCoverImage($coverImage);


            //Gestion de participations aux evenements
            for($j=1; $j<= mt_rand(0,10); $j++){
                $participation = new EventUser();
                $joinedAt = $faker->dateTimeBetween('-6 months');
                $amount = $faker->$montantCollecte = $faker->randomFloat(2, 0, 10000);
                $userJoined = $users[mt_rand(0, count($users)-1)];

                $participation->setEventId($event);
                $participation->setUserId($userJoined);
                $participation->setJoinDate($joinedAt);
                $participation->setAmount($amount);
                $manager->persist($participation);
            }


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
