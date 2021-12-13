<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EventUser;
use App\Form\Evenement1Type;
use App\Repository\EvenementRepository;
use App\Repository\EventCommentRepository;
use App\Repository\EventUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/evenement")
 */
class AdminEvenementController extends AbstractController
{
    /**
     * @Route("/", name="admin_evenement_index", methods={"GET"})
     */
    public function index(EvenementRepository $evenementRepository, Request $request, PaginatorInterface $paginator): Response
    {

        $user = $this->getUser();
        $donnees = $evenementRepository->findAll();

        $evenements = $paginator->paginate(
            $donnees,
            $request->query->getInt('page',1),
            4
        );

        return $this->render('evenement/admin_evenement/index.html.twig', [
            'evenements' => $evenements,
            'user' => $user,
        ]);
    }


    /**
     * @Route("/statistiques", name="admin_evenement_stats", methods={"GET"})
     */
    public function getStatistiques(EvenementRepository $evenementRepository, EventUserRepository $eventUserRepo, Request $request): Response
    {


        $user = $this->getUser();
        $todayDate = new \DateTime();

        $allEvents = $evenementRepository->findAll();
        $lastEvents = $evenementRepository->findLastCreatedEvents();

        $allParticipations = $eventUserRepo->findAll();
        $lastParticipations = $eventUserRepo->findLastParticipations();

        $bestParticipations = $eventUserRepo->findAllParticipations();

        $recentParticipations = $eventUserRepo->findRecentParticipations();


        $montantTotal = 0;
        $montantCurrentMonth = 0;

        foreach ($allParticipations as $i){
            $montantTotal = $montantTotal + $i->getAmount();
        }

        foreach ($lastParticipations as $i){
            $montantCurrentMonth = $montantCurrentMonth + $i->getAmount();
        }


        return $this->render('evenement/admin_evenement/stats.html.twig', [
            'user' => $user,
            'todayDate' => $todayDate,
            'allEvents' => $allEvents,
            'lastEvents' => $lastEvents,
            'allParticipations' => $allParticipations,
            'lastParticipations' => $lastParticipations,
            'montantTotal' => $montantTotal,
            'montantCurrentMonth' => $montantCurrentMonth,
            'bestParticipations' => $bestParticipations,
            'recentParticipations' => $recentParticipations,
        ]);
    }

    /**
     * @Route("/new", name="admin_evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evenement = new Evenement();
        $evenement->setMontantCollecte(0);
        $evenement->setNumParticipants(0);
        $form = $this->createForm(Evenement1Type::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('admin_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/admin_evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{eventId}/history", name="admin_evenement_show_history", methods={"GET"})
     */
    public function showHistory(Evenement $evenement, EventUserRepository $eventRepo): Response
    {


        $participation = $eventRepo->findJoinedEventByUser($evenement->getEventId());



        return $this->render('evenement/admin_evenement/show3.html.twig', [
            'participation' => $participation,
            'evenement' => $evenement
        ]);
    }

    /**
     * @Route("/{eventId}/comments", name="admin_evenement_show_comments", methods={"GET"})
     */
    public function showComments(Evenement $evenement, EventCommentRepository $commentRepo): Response
    {
        $comments = $commentRepo->findAllCommentsByEvent($evenement->getEventId());

        return $this->render('evenement/admin_evenement/show.html.twig', [
            'evenement' => $evenement,
            'comments' => $comments
        ]);
    }

    /**
     * @Route("/{eventId}", name="admin_evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement, EventCommentRepository $commentRepo): Response
    {
        $comments = $commentRepo->findAllCommentsByEvent($evenement->getEventId());

        return $this->render('evenement/admin_evenement/show2.html.twig', [
            'evenement' => $evenement,
            'comments' => $comments
        ]);
    }

    /**
     * @Route("/{eventId}/edit", name="admin_evenement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenement $evenement): Response
    {
        $form = $this->createForm(Evenement1Type::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/admin_evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{eventId}", name="admin_evenement_delete", methods={"POST"})
     */
    public function delete(Request $request, Evenement $evenement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getEventId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_evenement_index', [], Response::HTTP_SEE_OTHER);
    }
}
