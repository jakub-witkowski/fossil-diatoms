<?php

namespace App\Controller;

use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ByGenusController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
        

    #[Route('/by-genus', name: 'app_by_genus', methods: 'GET')]
    public function index(): Response
    {
        $repository = $this->em->getRepository(Photo::class);
        $photos = $repository->findBy([], [
            'id' => 'DESC'
        ]);

        $year = date('Y');

        return $this->render('by_genus/index.html.twig', [
            'controller_name' => 'ByGenusController',
            'photos' => $photos,
            'year' => $year
        ]);
    }
}
