<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EntryController extends AbstractController
{
    #[Route('/atlas/entry/{id<\d+>}', name: 'app_entry', methods: 'GET')]
    public function index(int $id, PhotoRepository $repository): Response
    {
        $photo = $repository->findPhotoById($id);

        if (!$photo) {
            throw $this->createNotFoundException('Photo not found');
        }

        $year = date('Y'); 

        return $this->render('entry/index.html.twig', [
            'controller_name' => 'EntryController',
            'year' => $year,
            'photo' => $photo
        ]);
    }
}
