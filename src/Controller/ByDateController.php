<?php

namespace App\Controller;

use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ByDateController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
        

    #[Route('/atlas/by-date', name: 'app_by_date', methods: 'GET')]
    public function index(): Response
    {
        $repository = $this->em->getRepository(Photo::class);
        $photos = $repository->findBy(['isPublished' => 'true'], [
            'id' => 'DESC'
        ]);

        $year = date('Y');

        return $this->render('by_date/index.html.twig', [
            'controller_name' => 'ByDateController',
            'photos' => $photos,
            'year' => $year
        ]);
    }
}
