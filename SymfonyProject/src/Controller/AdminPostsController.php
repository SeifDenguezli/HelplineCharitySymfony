<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Posts;
use App\Entity\User;
use App\Form\Posts1Type;
use App\Repository\PostsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use JCrowe\BadWordFilter\Facades\BadWordFilter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/posts")
 */
class AdminPostsController extends AbstractController
{
    /**
     * @Route("/", name="admin_posts_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $posts = $entityManager
            ->getRepository(Posts::class)
            ->findAll();


return $this->render('posts/admin_posts/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/new", name="admin_posts_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Posts();
        $post->setUser($this->getUser());
        $post->setPostpic("https://cdn.vox-cdn.com/thumbor/OTaHOVtIR6t8L0doPD-Kq6XYqeA=/0x0:1754x1241/1200x800/filters:focal(737x481:1017x761)/cdn.vox-cdn.com/uploads/chorus_image/image/68040475/GettyImages_1060748862.0.jpg");
        $post->setPostdate(new \DateTime('now'));
        $post->setLikecount(0);
        $post->setViewcount(0);
        $form = $this->createForm(Posts1Type::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('admin_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posts/admin_posts/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{postid}", name="admin_posts_show", methods={"GET"})
     */
    public function show(Posts $post,PostsRepository $postsrep): Response
    {    $user = $this->getDoctrine()->getRepository(User::class)->find($post->getUser());
        $comment = $this->getDoctrine()->getRepository(Comments::class)->findBypostid($post->getPostid());
        $bost2 = $postsrep->findPostsofuser($post->getUser());
        return $this->render('posts/admin_posts/show.html.twig', [
            'post' => $post,'user'=>$user,'comment'=>$comment,'bost2'=>$bost2,
        ]);
    }

    /**
     * @Route("/{postid}/edit", name="admin_posts_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Posts $post, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Posts1Type::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posts/admin_posts/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{postid}", name="admin_posts_delete", methods={"GET","POST"})
     */
    public function delete(Request $request, Posts $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getPostid(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();

        }

        return $this->redirectToRoute('admin_posts_index', [], Response::HTTP_SEE_OTHER);
    }
}
