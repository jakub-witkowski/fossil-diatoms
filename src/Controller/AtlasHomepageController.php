<?php

namespace App\Controller;

use App\Entity\Genus;
use App\Entity\Photo;
use App\Entity\Species;
use App\Entity\Update;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AtlasHomepageController extends AbstractController
{
    #[Route('/', name: 'app_atlas_homepage', methods: 'GET')]
    public function index(EntityManagerInterface $em): Response
    {
        $speciesRepository = $em->getRepository(Species::class);
        $species = $speciesRepository->count();

        $generaRepository = $em->getRepository(Genus::class);
        $genera = $generaRepository->count();

        $photoRepository = $em->getRepository(Photo::class);
        $photos = $photoRepository->count();

        $updateRepository = $em->getRepository(Update::class);
        $updates = $updateRepository->findBy([], [
            'id' => 'DESC'
        ], 3);

        $year = date('Y');

        return $this->render('atlas_homepage/index.html.twig', [
            'controller_name' => 'AtlasHomepageController',
            'species' => $species,
            'genera' => $genera,
            'photos' => $photos,
            'updates' => $updates,
            'year' => $year
        ]);
    }
}