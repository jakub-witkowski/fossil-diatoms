<?php

namespace App\Controller;

// use App\Repository\PhotoRepository;

use App\Repository\GenusRepository;
use App\Repository\SiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SiteListController extends AbstractController
{
    #[Route('/atlas/site-list', name: 'app_site_list', methods: 'GET')]
    public function index(SiteRepository $siteRepository, GenusRepository $genusRepository): Response
    {
        $numberOfGenera = $genusRepository->count();
        $listOfGenera = $genusRepository->findBy([],[
            'name' => 'ASC'
        ]);
        $listOfSites = $siteRepository->findBy([], [
            'siteType' => 'ASC',
            'nameOrNumberPrimary' => 'ASC'
        ]);

        $year = date('Y');

        return $this->render('site_list/index.html.twig', [
            'controller_name' => 'SiteListController',
            'numberOfGenera' => $numberOfGenera,
            'listOfGenera' => $listOfGenera,
            'listOfSites' => $listOfSites,
            'year' => $year,
        ]);
    }
}
