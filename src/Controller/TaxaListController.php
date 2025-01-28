<?php

namespace App\Controller;

use App\Repository\GenusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaxaListController extends AbstractController
{
    #[Route('/atlas/taxa-list', name: 'app_taxa_list', methods: 'GET')]
    public function index(GenusRepository $genusRepository): Response
    {
        // $numberOfGenera = $genusRepository->count();
        $listOfGenera = $genusRepository->findBy([],[
            'name' => 'ASC'
        ]);

        // dd($listOfGenera);

        $year = date('Y');

        return $this->render('taxa_list/index.html.twig', [
            'controller_name' => 'TaxaListController',
            // 'numberOfGenera' => $numberOfGenera,
            'listOfGenera' => $listOfGenera,
            'year' => $year,
        ]);
    }
}
