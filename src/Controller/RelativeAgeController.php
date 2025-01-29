<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RelativeAgeController extends AbstractController
{
    #[Route('/atlas/relative-age/{relativeAgeId<\d+>}', name: 'app_relative_age')]
    public function index(PhotoRepository $photoRepository, $relativeAgeId): Response
    {
        $photos = $photoRepository->findPhotosByAge($relativeAgeId);

        if (!$photos) {
            throw $this->createNotFoundException('Relative age not found');
        }

        return $this->render('relative_age/index.html.twig', [
            'controller_name' => 'AgeController',
            'photos' => $photos
        ]);
    }
}