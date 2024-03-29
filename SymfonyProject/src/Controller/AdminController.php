<?php
namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/service")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_service_index", methods={"GET"})
     */
    public function index(ServiceRepository $serviceRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $serviceRepository->findAll();

        $services = $paginator->paginate(
            $donnees,
            $request->query->getInt('page',1),
            4

        );
        return $this->render('service/admin_service/index.html.twig', [
            'services' => $services,
        ]);
    }

    /**
     * @Route("/new", name="admin_service_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $service = new service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('admin_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_service/new.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{serviceid}", name="admin_service_show", methods={"GET"})
     */
    public function show(Service $service): Response
    {
        return $this->render('service/admin_service/show.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/{serviceid}/edit", name="admin_service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Service $service): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('service/admin_service/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{serviceid}", name="admin_service_delete", methods={"POST"})
     */
    public function delete(Request $request, Service $service): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getserviceId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_service_index', [], Response::HTTP_SEE_OTHER);
    }
}