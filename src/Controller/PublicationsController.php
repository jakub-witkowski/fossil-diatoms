<?php

namespace App\Controller;

use App\Entity\Publication;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PublicationsController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
        
    #[Route('/publications', name: 'app_publications', methods: 'GET')]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Publication::class);
        $publications = $repository->findBy([], [
            'id' => 'DESC'
        ]);

        return $this->render('publications/index.html.twig', [
            'controller_name' => 'PublicationsController',
            'publications' => $publications
        ]);
    }
}
