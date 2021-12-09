<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\SearchServiceType;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SearchController extends AbstractController
{
    /**
     * @Route("/service/search", name="service_search")
     * @param Request $request
     * @param $ServiceRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchService(Request $request, ServiceRepository $ServiceRepository)
    {
        $searchServiceForm = $this->createForm(SearchServiceType::class);
        if($searchServiceForm->handleRequest($request)->isSubmitted()&& $searchServiceForm->isValid()) {

            $criteria = $searchServiceForm->getData();

            $service = $ServiceRepository->findByExampleField($criteria);
            dd($criteria);
        }

        return $this->render('don/search.html.twig', [
            'search_form' => $searchServiceForm->createView(),
        ]);
    }

}