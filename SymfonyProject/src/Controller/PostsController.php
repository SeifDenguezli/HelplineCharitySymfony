<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Posts;
use App\Entity\User;
use App\Form\PostsType;
use App\Repository\PostsRepository;
use Illuminate\Support\Facades\Notification;
use JCrowe\BadWordFilter\Facades\BadWordFilter;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommentsType;
/**
 * @Route("/p1")
 */
class PostsController extends AbstractController
{
    /**
     * @Route("/posthome", name="posts_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator,Request $request  ): Response
    {
        $posts = $this->getDoctrine()
            ->getRepository(Posts::class)
            ->findAll();

        $posts= $paginator->paginate(
            $posts,
            $request->query->getInt('page',1),5
        );


        return $this->render('posts/index.html.twig', [
            'posts' => $posts,
        ]);
    }


    /**
     * @Route("/newpost", name="posts_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $post = new Posts();
        $post->setUser($this->getUser());
        $post->setPostdate(new \DateTime('now'));
        $post->setLikecount(0);

        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $filter = new \JCrowe\BadWordFilter\BadWordFilter();
            $trash =$filter->clean($post->getPostcontent());
            $post->setPostcontent($trash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posts/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{postid}", name="posts_show", methods={"GET","POST"})
     */
    public function show(Posts $post,Request $request,PostsRepository $postsrep):Response
    {   $post->setViewcount($post->getViewcount()+1);
        $entityManager1 = $this->getDoctrine()->getManager();
        $entityManager1->persist($post);
        $entityManager1->flush();
        $comment = $this->getDoctrine()->getRepository(Comments::class)->findBypostid($post->getPostid());
        $comment1 = new Comments();
        $comment1->setPostid($post);
        $comment1->setCommentdate(new \DateTime('now'));
        $comment1->setCommentauthor($this->getUser()->getUsername());
        $comment1->setLikecount(0);
        $form = $this->createForm(CommentsType::class,$comment1 );
        $bost = $postsrep->findByLikeCount(10,false);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $filter = new \JCrowe\BadWordFilter\BadWordFilter();

            $trash =$filter->clean($comment1->getCommentcontent());
            $comment1->setCommentcontent($trash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment1);
            $entityManager->flush();



            return $this->redirectToRoute('posts_index',[], Response::HTTP_SEE_OTHER);
        }
        return $this->render('posts/show.html.twig', [
           'post' => $post,'comment'=>$comment,'form' => $form->createView(),'bost'=>$bost,
        ]);

    }

    /**
     * @Route("/{postid}/edit", name="posts_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Posts $post): Response
    {
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posts/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{postid}", name="posts_delete", methods={"POST"})
     */
    public function delete(Request $request, Posts $post): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getPostid(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('posts_index', [], Response::HTTP_SEE_OTHER);
    }

}
