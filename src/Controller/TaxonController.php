<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Pagerfanta\Pagerfanta;

class TaxonController extends AbstractController
{
    #[Route('/taxon/{genus}', name: 'app_taxon', methods: 'GET')]
    public function index(PhotoRepository $photoRepository, Request $request, string $genus): Response
    {
        $photos = $photoRepository->findPhotosByGenus($genus);

        if (!$photos) {
            throw $this->createNotFoundException('Genus not found');
        }

//        $adapter = new QueryAdapter($photos);
//        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
//            $adapter,
//            $request->query->get('page', 1),
//            6
//        );

        return $this->render('taxon/index.html.twig', [
            'controller_name' => 'TaxonController',
            'genus' => $genus,
            'photos' => $photos,
//            'pager' => $pagerfanta,
        ]);
    }
}
