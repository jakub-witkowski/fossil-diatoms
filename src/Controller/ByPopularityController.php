<?php

namespace App\Controller;

use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ByPopularityController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
        
    #[Route('/atlas/by-popularity', name: 'app_by_popularity', methods: 'GET')]
    public function index(): Response
    {
        $repository = $this->em->getRepository(Photo::class);
        $photos = $repository->findBy([], [
            'timesViewed' => 'DESC'
        ]);

        $year = date('Y');

        return $this->render('by_popularity/index.html.twig', [
            'controller_name' => 'ByPopularityController',
            'photos' => $photos,
            'year' => $year
        ]);
    }
}
