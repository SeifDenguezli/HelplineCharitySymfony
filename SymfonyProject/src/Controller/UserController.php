<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Faker\Factory;


/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/stats", name="user_stats", methods={"GET"})
     */
    public function getStats(UserRepository $userRepository,  Request $request): Response
    {

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        $admins = $userRepository->findUsersByRole('Admin');
        $associations = $userRepository->findUsersByRole('Association');
        $donneurs = $userRepository->findUsersByRole('Donneur');
        return $this->render('user/stats.html.twig', [
            'users' => $users,
            'admins' => $admins,
            'associations' => $associations,
            'donneurs' => $donneurs,
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/fake", name="user_fake")
     */
    public function load(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $faker = Factory::create('FR-fr');

        $users = [100];
        $genres = ['male', 'female'];

        //Generation Users
        for($i=1; $i <= 10; $i++) {
            $user = new User();
            $genre = $faker->randomElement($genres);

            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1,99) . '.jpg';

            if ($genre == 'male') $picture = $picture . 'men/' . $pictureId;
            else $picture = $picture . 'women/' . $pictureId;

            $user->setUsername($faker->name($genre));
            $user->setPassword($faker->password);
            $user->setCity($faker->city);
            $user->setGouvernorat($faker->city);
            $user->setPhone($faker->phoneNumber);
            $user->setMail($faker->email);
            $user->setRole($faker->name);
            $user->setMontantDonne($faker->randomFloat());
            $user->setPhoto($picture);
            $manager->persist($user);
            $users[] = $user;



            $manager->persist($users[$i]);
        }

        $manager->flush();
        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{userid}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{userid}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{userid}", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getUserid(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }


}
