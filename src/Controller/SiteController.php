<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use App\Repository\SiteRepository;
//use Pagerfanta\Doctrine\ORM\QueryAdapter;
//use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SiteController extends AbstractController
{
    #[Route('/site/{siteId}', name: 'app_site', methods: 'GET')]
    public function index(PhotoRepository $photoRepository, SiteRepository $siteRepository, Request $request, int $siteId): Response
    {
        $photos = $photoRepository->findPhotosBySite($siteId);
        $site = $siteRepository->findOneBy(['id' => $siteId]);

        if (!$photos) {
            throw $this->createNotFoundException('Genus not found');
        }


        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'photos' => $photos,
            'site' => $site,
//            'pager' => $pagerfanta,
        ]);
    }
}
