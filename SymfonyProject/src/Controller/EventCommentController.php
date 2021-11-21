<?php

namespace App\Controller;

use App\Entity\EventComment;
use App\Form\EventCommentType;
use App\Repository\EventCommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event/comment")
 */
class EventCommentController extends AbstractController
{


    /**
     * @Route("/new", name="event_comment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $eventComment = new EventComment();
        $form = $this->createForm(EventCommentType::class, $eventComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eventComment);
            $entityManager->flush();

            return $this->redirectToRoute('event_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event_comment/new.html.twig', [
            'event_comment' => $eventComment,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="event_comment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EventComment $eventComment): Response
    {
        $form = $this->createForm(EventCommentType::class, $eventComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event_comment/edit.html.twig', [
            'event_comment' => $eventComment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_comment_delete", methods={"POST"})
     */
    public function delete(Request $request, EventComment $eventComment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventComment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($eventComment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_comment_index', [], Response::HTTP_SEE_OTHER);
    }
}
