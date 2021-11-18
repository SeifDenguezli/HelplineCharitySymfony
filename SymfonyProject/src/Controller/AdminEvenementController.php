<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\Evenement1Type;
use App\Repository\EvenementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

        $donnees = $evenementRepository->findAll();

        $evenements = $paginator->paginate(
            $donnees,
            $request->query->getInt('page',1),
            4

        );


        return $this->render('evenement/admin_evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    /**
     * @Route("/new", name="admin_evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evenement = new Evenement();
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
     * @Route("/{eventId}", name="admin_evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/admin_evenement/show.html.twig', [
            'evenement' => $evenement,
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
