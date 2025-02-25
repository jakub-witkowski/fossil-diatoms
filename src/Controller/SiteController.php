<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use App\Repository\SiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SiteController extends AbstractController
{
    #[Route('/atlas/site/{siteId}', name: 'app_site', methods: 'GET')]
    public function index(PhotoRepository $photoRepository, SiteRepository $siteRepository, int $siteId): Response
    {
        $photos = $photoRepository->findPhotosBySite($siteId);
        $site = $siteRepository->findOneBy(['id' => $siteId]);

        if (!$photos) {
            throw $this->createNotFoundException('Site not found');
        }

        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'photos' => $photos,
            'site' => $site,
        ]);
    }
}
