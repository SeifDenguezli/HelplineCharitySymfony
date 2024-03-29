<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EventComment;
use App\Entity\EventUser;
use App\Entity\Role;
use App\Entity\User;
use App\Form\EvenementType;
use App\Form\EventCommentType;
use App\Repository\EvenementRepository;
use App\Repository\EventCommentRepository;
use App\Repository\EventUserRepository;
use Faker\Factory;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{


    /**
     * @Route("/", name="evenement_index", methods={"GET"})
     * @IsGranted("ROLE_USER")
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
     * @Route("/new", name="evenement_new")
     */
    public function new(Request $request, \Swift_Mailer $mailer): Response
    {
        $currentUser = $this->getUser();
        $evenement = new Evenement();
        $evenement->setMontantCollecte(0);
        $evenement->setNumParticipants(0);
        $evenement->setAssociationId($currentUser);
        $nowDate = new \DateTime('now');
        $evenement->setDateCreation($nowDate);
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            $message = (new \Swift_Message('Création Evenement avec Succées'))
                ->setContentType('text/html')
                ->setFrom('helplinecharityapp@gmail.com')
                ->setTo('seifeddine.denguezli@esprit.tn');
            $message->setBody(
                $this->render('shared/emailEvent.html.twig', ['evenement' => $evenement, 'date' =>$nowDate])
            );
            $mailer->send($message);
            return $this->redirectToRoute('evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'user' => $currentUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/getFakeData", name="getFakeData")
     */
    public function getFakeData(UserPasswordEncoderInterface $encoder): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $faker = Factory::create('FR-fr');


        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $hash = $encoder->encodePassword($adminUser, 'password');
        $adminUser->setName($faker->name('male'));
        $adminUser->setPassword($hash);
        $adminUser->setCity($faker->city);
        $adminUser->setGouvernorat($faker->state);
        $adminUser->setPhone($faker->phoneNumber);
        $adminUser->setMail($faker->email);
        $adminUser->setRole("Admin");
        $adminUser->setMontantDonne($faker->randomFloat());
        $adminUser->setPhoto("https://randomuser.me/api/portraits/men/22.jpg");
        $adminUser->addUserRole($adminRole);
        $manager->persist($adminUser);






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
            $hash = $encoder->encodePassword($user, 'password');

            $user->setName($faker->name($genre));
            $user->setPassword($hash);
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
            $dateCreation = $faker->dateTimeBetween('-6 months');
            $montantCollecte = $faker->randomFloat(2, 0, 10000);
            $description = $faker->paragraph(3);
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

                //Faire quelques commentaires sur des événements
                if (mt_rand(0, 1)){ //50% chance de faire un commentaires aléatoire
                    $comment = new EventComment();
                    $comment->setContent($faker->paragraph());
                    $comment->setRating(mt_rand(1,5));
                    $comment->setUser($userJoined); //Relier le commentaire à l'utilisateur qui a partciper à cet event
                    $comment->setEvent($event); // Relier le comment à l'évenement participé
                    $manager->persist($comment);

                }

                $manager->persist($participation);
            }


            $manager->persist($event);
            $manager->flush();
        }

        return $this->redirectToRoute('evenement_index', []);
    }



    /**
     * @Route("/{eventId}", name="evenement_show")
     * @IsGranted("ROLE_USER")
     */
    public function show(Evenement $evenement, EventCommentRepository $repo, EventUserRepository $eventUserRepo, EvenementRepository $eventRepository, Request $request): Response
    {

        //Extraire tous les commentaires postulés durant l'évènements
        $comments = $repo->findAllCommentsByEvent($evenement->getEventId());

        //Extraire les donneurs recents de l'évènement

        $donneurs = $eventUserRepo->findJoinedEventByUser($evenement->getEventId());

        //Extraire les autres èvenements créer par l'association organisatrice de l'évènement
        $relatifEvents = $eventRepository->findEventsByAssociationId($evenement->getAssociationId());

        //Extraire la moyenne des ratings
        $avgRating = $repo->findAvgCommentRatingByEvent($evenement->getEventId());

        //Création du formulaire de commentaire et enregistrement du commentaire
        $eventComment = new EventComment();

        $form = $this->createForm(EventCommentType::class, $eventComment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $eventComment->setUser($this->getUser());
            $eventComment->setEvent($evenement);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eventComment);
            $entityManager->flush();

            return $this->redirectToRoute('evenement_show', ['eventId' => $evenement->getEventId()]);
        }

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'comments' => $comments,
            'donneurs' => $donneurs,
            'relatifEvents' => $relatifEvents,
            'avgRatings' => $avgRating,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/{eventId}/edit", name="evenement_edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_USER') and user === evenement.getAssociationId()")
     */
    public function edit(Request $request, Evenement $evenement): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'user' => $user,
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
