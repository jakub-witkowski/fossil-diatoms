<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaxonController extends AbstractController
{
    #[Route('/atlas/taxon/{genus}', name: 'app_taxon')]
    public function index(PhotoRepository $photoRepository, $genus): Response
    {
        $photos = $photoRepository->findPhotosByGenus($genus);

        if (!$photos) {
            throw $this->createNotFoundException('Genus not found');
        }

        return $this->render('taxon/index.html.twig', [
            'controller_name' => 'TaxonController',
            'photos' => $photos,
        ]);
    }
}
