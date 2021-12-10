<?php

namespace App\Controller;

use App\Entity\Recompense;
use App\Entity\Shop;
use App\Entity\User;
use App\Form\ShopType;
use App\Repository\ShopRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shop")
 */
class ShopController extends AbstractController
{
    /**
     * @Route("/", name="shop_index", methods={"GET"})
     */
    public function index(ShopRepository $shopRepository, Request $request, PaginatorInterface $paginator): Response
    {

        $donnees = $shopRepository->findAll();
        $shops = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), 10);

        return $this->render('shop/index.html.twig', [
            'shops' => $shops,
        ]);
    }

    /**
     * @Route("/front", name="shop_front_index", methods={"GET"})
     */

    public function showFront(ShopRepository $shopRepository, Request $request, PaginatorInterface $paginator): Response
    {

        $donnees = $shopRepository->findAll();
        $shops = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), 8);

        return $this->render('shop/indexFront.html.twig', [

            'shops' => $shops,

        ]);
    }

    /**
     * @Route("/new", name="shop_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $shop = new Shop();
        $form = $this->createForm(ShopType::class, $shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($shop);
            $entityManager->flush();

            return $this->redirectToRoute('shop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('shop/new.html.twig', [
            'shop' => $shop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{shopId}", name="shop_show", methods={"GET"})
     */
    public function show(Shop $shop): Response
    {
        return $this->render('shop/show.html.twig', [
            'shop' => $shop,
        ]);
    }

    /**
     * @Route("/{shopId}/edit", name="shop_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Shop $shop): Response
    {
        $form = $this->createForm(ShopType::class, $shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('shop/edit.html.twig', [
            'shop' => $shop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{shopId}", name="shop_delete", methods={"POST"})
     */
    public function delete(Request $request, Shop $shop): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shop->getShopId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shop);
            $entityManager->flush();
        }

        return $this->redirectToRoute('shop_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{shopId}/rooted", name="shop_buy", methods={"GET","POST","PUT"})
     */
    public function Buy(Shop $shop, \Swift_Mailer $mailer)
    {
        $user = $this->getUser();
        $recomponse1 = $this->getDoctrine()->getRepository(Recompense::class)->findOneBydonorid($user->getUserid());
        if( $shop->getQte() > 0 && $recomponse1->getNbrepoints() > $shop->getCost())
        {
            $shop->setQte($shop->getQte() - 1);
            $entityManager1 = $this->getDoctrine()->getManager();
            $entityManager1->persist($shop);
            $entityManager1->flush();

            $recomponse1 = $this->getDoctrine()->getRepository(Recompense::class)->findOneBydonorid($user->getUserid());
            $rec = $recomponse1->getNbrepoints();
            $rec = $rec - $shop->getCost() ;
            $recomponse1->setNbrepoints($rec);
            $entityManager1->persist($recomponse1);
            $entityManager1->flush();
            $message = (new \Swift_Message('Nouveau Contact'))
                ->setContentType('text/html')
                ->setFrom('wael.ibnellaherich@gmail.com')
                ->setTo($user->getMail())
                ->setBody(
                    $this->renderView(
                        'emails/buy.html.twig', ['shop' => $shop]))
            ;
            $mailer->send($message);
            $this->addFlash('message', 'Transformation de points avec succées ! Vous allez reçevoir un mail');
            return $this->redirectToRoute('shop_front_index', [], Response::HTTP_SEE_OTHER);
        }

        else{

            $message = (new \Swift_Message('Nouveau Contact'))
                ->setContentType('text/html')
                ->setFrom('wael.ibnellaherich@gmail.com')
                ->setTo('wael.ibnellaherich@gmail.com')
                ->setBody('Veuiller verifier que vous avez encore des points de fidélité ou vous avez demandez un produit qui est déja expiré')
            ;
            $mailer->send($message);
            $this->addFlash('message', 'Transformation de points avec succées ! Vous allez reçevoir un mail');
            return $this->redirectToRoute('shop_front_index', [], Response::HTTP_SEE_OTHER);

        }

        return $this->redirectToRoute('shop_front_index', [], Response::HTTP_SEE_OTHER);
    }
}