<?php

namespace App\Controller;

use App\Entity\Recompense;
use App\Form\RecompenseType;
use App\Repository\RecompenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recompense")
 */
class RecompenseController extends AbstractController
{
    /**
     * @Route("/", name="recompense_index", methods={"GET"})
     */
    public function index(): Response
    {
        $recompenses = $this->getDoctrine()
            ->getRepository(Recompense::class)
            ->findAll();

        return $this->render('recompense/index.html.twig', [
            'recompenses' => $recompenses,
        ]);
    }

    /**
     * @Route("/new", name="recompense_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recompense = new Recompense();
        $form = $this->createForm(RecompenseType::class, $recompense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recompense);
            $entityManager->flush();

            return $this->redirectToRoute('recompense_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recompense/new.html.twig', [
            'recompense' => $recompense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{recompenseid}", name="recompense_show", methods={"GET"})
     */
    public function show(Recompense $recompense): Response
    {
        return $this->render('recompense/show.html.twig', [
            'recompense' => $recompense,
        ]);
    }

    /**
     * @Route("/{recompenseid}/edit", name="recompense_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Recompense $recompense): Response
    {
        $form = $this->createForm(RecompenseType::class, $recompense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recompense_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recompense/edit.html.twig', [
            'recompense' => $recompense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{recompenseid}", name="recompense_delete", methods={"POST"})
     */
    public function delete(Request $request, Recompense $recompense): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recompense->getRecompenseid(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recompense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recompense_index', [], Response::HTTP_SEE_OTHER);
    }
}
