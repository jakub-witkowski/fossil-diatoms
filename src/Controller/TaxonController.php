<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaxonController extends AbstractController
{
    #[Route('/atlas/taxon/{genus}', name: 'app_taxon')]
    public function index(PhotoRepository $photoRepository, $genus, Request $request): Response
    {
        $photos = $photoRepository->findPhotosByGenus($genus);

        // return new JsonResponse($photos);

        // dd($photos);

        if (!$photos) {
            throw $this->createNotFoundException('Genus not found');
        }

        // $year = date('Y');

        // if ($request->isXmlHttpRequest()){
        return $this->render('taxon/index.html.twig', [
            'controller_name' => 'TaxonController',
            'photos' => $photos,
            // 'year' => $year,
        ]);
        // }
    }
}
