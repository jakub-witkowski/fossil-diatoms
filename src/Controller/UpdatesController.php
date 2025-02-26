<?php

namespace App\Controller;

use App\Entity\Update;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UpdatesController extends AbstractController
{
    #[Route('/updates', name: 'app_updates', methods: 'GET')]
    public function index(EntityManagerInterface $em): Response
    {
        $updateRepository = $em->getRepository(Update::class);
        $updates = $updateRepository->findBy([], [
            'id' => 'DESC'
        ]);

        $year = date('Y');

        return $this->render('updates/index.html.twig', [
            'controller_name' => 'UpdatesController',
            'updates' => $updates,
            'year' => $year
        ]);
    }
}
