<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AgeController extends AbstractController
{
    #[Route('/atlas/age/{relativeAgeId}', name: 'app_age')]
    public function index(PhotoRepository $photoRepository, $relativeAgeId): Response
    {
        $photos = $photoRepository->findPhotosBySite($relativeAgeId);

        if (!$photos) {
            throw $this->createNotFoundException('Relative age not found');
        }

        return $this->render('age/index.html.twig', [
            'controller_name' => 'AgeController',
            'photos' => $photos
        ]);
    }
}
