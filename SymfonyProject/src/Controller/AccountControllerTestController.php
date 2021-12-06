<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountControllerTestController extends AbstractController
{
    /**
     * @Route("/login", name="account_login")
     */
    public function login(): Response
    {
        return $this->render('account_controller_test/login.html.twig');
    }
}
