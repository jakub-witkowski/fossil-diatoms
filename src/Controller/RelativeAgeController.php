<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use App\Repository\RelativeAgeRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RelativeAgeController extends AbstractController
{
    #[Route('/relative-age/{relativeAgeId<\d+>}', name: 'app_relative_age', methods: 'GET')]
    public function index(PhotoRepository $photoRepository, RelativeAgeRepository $relativeAgeRepository, Request $request, int $relativeAgeId): Response
    {
        $photos = $photoRepository->findPhotosByAge($relativeAgeId);
        $age = $relativeAgeRepository->findOneBy(['id' => $relativeAgeId]);

        if (!$photos) {
            throw $this->createNotFoundException('Relative age not found');
        }

        $adapter = new QueryAdapter($photos);
        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page', 1),
            6
        );

        return $this->render('relative_age/index.html.twig', [
            'controller_name' => 'AgeController',
//            'photos' => $photos,
            'age' => $age,
            'pager' => $pagerfanta,
        ]);
    }
}