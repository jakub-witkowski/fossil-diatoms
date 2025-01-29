<?php

namespace App\Controller;

use App\Repository\RelativeAgeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RelativeAgeListController extends AbstractController
{
    #[Route('/atlas/relative-age-list', name: 'app_relative_age_list', methods: 'GET')]
    public function index(RelativeAgeRepository $relativeAgeRepository): Response
    {
        $listOfAges = $relativeAgeRepository->findBy([], [
            'midpointDate' => 'DESC',
        ]);

        $year = date('Y');

        return $this->render('relative_age_list/index.html.twig', [
            'controller_name' => 'RelativeAgeListController',
            'listOfAges' => $listOfAges,
            'year' => $year,
        ]);
    }
}
