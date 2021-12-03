<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\Email;
use App\Services\Mailer;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class SecurityController extends AbstractController
{
    /*public static function getSubscribedEvents(){
        return[
           UserRegisterEvent::NAME=>'onUserRegister'
        ];
    }
    public function onUserRegister(UserRegisterEvent $event){
    $body = $this->twig->render('mail/registration.html.twig',[
        'user'=>$event->getRegisteredUser()
    ]);
    $message=(new \Swift_Message())
        ->setSubject('welcome')
        ->setFrom('helplinecharityconfirm@gmail.com')
        ->setTo($event->getRegisteredUser()->getEmail())
        ->setBody('Welcome tothe club');
    $this->mailer->send($message);
    }*/
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder){
        $user= new User();
        $form= $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            //onUserRegister();
            $this->addFlash('success', 'Article Created! Knowledge is power!');
            return  $this->redirectToRoute('security_login');

        }

        return $this->render('security/registration.html.twig',[
            'form'=>$form->createView()
            ]
        );

    }

        /**
         * @Route("/connexion", name="security_login")
         */
        public function login(AuthenticationUtils $authenticationUtils){
            $error=$authenticationUtils->getLastAuthenticationError();
            $lastUsername = $authenticationUtils->getLastUsername();
            return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
                'error' =>$error
                ]);
        }

        /**
         * @Route("/deconnexion",name="security_logout")
         */
        public function logout(){}

    /**
     * @Route ("/AcceuilA",name="acceuil")
     */
    public function tohome(Request $request): Response
    {
    return $this->render('home.html.twig', [

    ]);
    }


}
