<?php

namespace App\Controller;

use App\Repository\RelativeAgeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GeologicalAgeListController extends AbstractController
{
    #[Route('/atlas/age-list', name: 'app_age_list', methods: 'GET')]
    public function index(RelativeAgeRepository $relativeAgeRepository): Response
    {
        $listOfAges = $relativeAgeRepository->findBy([], [
            'midpointDate' => 'DESC',
        ]);

        // dd($listOfAges);

        $year = date('Y');

        return $this->render('age_list/index.html.twig', [
            'controller_name' => 'GeologicalAgeListController',
            'listOfAges' => $listOfAges,
            'year' => $year,
        ]);
    }
}
