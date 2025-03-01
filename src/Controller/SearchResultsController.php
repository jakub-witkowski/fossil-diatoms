<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchResultsController extends AbstractController
{
    #[Route('/search-results', name: 'app_search_results', methods: 'GET')]
    public function index(PhotoRepository $photoRepository, Request $request): Response
    {
        $queryBuilder = $photoRepository->sortPhotosByGenusAndSpecies();
        $adapter = new QueryAdapter($queryBuilder);
        
        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page', 1),
            6
        );

        $year = date('Y');

        return $this->render('search_results/index.html.twig', [
            'controller_name' => 'SearchResultsController',
            'year' => $year,
            'pager' => $pagerfanta,
        ]);
    }
}
