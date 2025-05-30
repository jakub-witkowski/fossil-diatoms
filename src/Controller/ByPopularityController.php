<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ByPopularityController extends AbstractController
{        
    #[Route('/by-popularity', name: 'app_by_popularity', methods: 'GET')]
    public function index(PhotoRepository $photoRepository, Request $request): Response
    {
        $queryBuilder = $photoRepository->sortPublishedPhotosByPopularity();
        $adapter = new QueryAdapter($queryBuilder);
        
        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page', 1),
            6
        );
        
        $year = date('Y');

        return $this->render('by_popularity/index.html.twig', [
            'controller_name' => 'ByPopularityController',
            'year' => $year,
            'pager' => $pagerfanta,
        ]);
    }
}
