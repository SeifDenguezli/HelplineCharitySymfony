<?php

namespace App\Controller;

use App\Form\ReclamationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationController extends AbstractController
{
    /**
     * @Route("/reclamation", name="reclamation")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request,\Swift_Mailer $mailer)
    {

        $form = $this->createForm(ReclamationType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $reclamation = $form->getData();
            // ici on enverrons le mail
            $message = (new \Swift_Message("Nouvelle Reclmation"))
            // ici on l'expéditeur
            ->setFrom($reclamation['email'])
                // ici on le destinataire
            ->setTo('laouinikhoubaib@gmail.com')
                //message avec twig
            ->setBody(
                $this->renderView(
                    'Mail/reclamation.html.twig',compact('reclamation')

                ),
                    'text/html'
                )
                ;
            //envoi de message
            $mailer->send($message);
                $this->addFlash('message','La réclamation a bien été envoyée');
            return $this->redirectToRoute('service_index', [], Response::HTTP_SEE_OTHER);

        }

        return $this->render('reclamation/index.html.twig', [
            'reclamationForm' => $form->createView()
        ]);


    }


}
