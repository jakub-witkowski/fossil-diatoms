<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ByDateController extends AbstractController
{
    #[Route('/by-date', name: 'app_by_date', methods: 'GET')]
    public function index(PhotoRepository $photoRepository, Request $request): Response
    {
        $queryBuilder = $photoRepository->sortPublishedPhotosByDate();
        $adapter = new QueryAdapter($queryBuilder);

        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page', 1),
            6
        );

        $year = date('Y');

        return $this->render('by_date/index.html.twig', [
            'controller_name' => 'ByDateController',
            'year' => $year,
            'pager' => $pagerfanta,
        ]);
    }
}
