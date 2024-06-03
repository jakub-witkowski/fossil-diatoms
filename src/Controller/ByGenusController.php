<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ByGenusController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
        
    #[Route('/atlas/by-genus', name: 'app_by_genus', methods: 'GET')]
    public function index(PhotoRepository $photoRepository, Request $request): Response
    {
        // $photos = $this->em->getRepository(Photo::class)->sortPhotosByGenusAndSpecies();

        $queryBuilder = $photoRepository->sortPhotosByGenusAndSpecies();
        $adapter = new QueryAdapter($queryBuilder);
        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page', 1),
            9
        );

        $year = date('Y');

        return $this->render('by_genus/index.html.twig', [
            'controller_name' => 'ByGenusController',
            // 'photos' => $photos,
            'year' => $year,
            'pager' => $pagerfanta,
        ]);
    }
}
