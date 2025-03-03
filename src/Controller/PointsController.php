<?php

namespace App\Controller;

use App\Enum\Resource;
use App\Factory\InPostServiceFactory;
use App\Form\SearchPointsFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PointsController extends AbstractController
{
    public function __construct(private readonly InPostServiceFactory $apiServiceFactory)
    {
    }

    #[Route('/points', name: 'app_points')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(SearchPointsFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $apiService = $this->apiServiceFactory->create(Resource::Points);
            $results = $apiService->fetchData($form->getData()['city']);
        }

        return $this->render('points/index.html.twig', [
            'form' => $form->createView(),
            'results' => $results ?? [],
        ]);
    }
}
