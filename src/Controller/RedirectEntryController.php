<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RedirectEntryController extends AbstractController
{

    #[Route('/atlas/entry/{id<\d+>}', name: 'old_app_entry', methods: 'GET')]
    public function index(int $id): Response
    {
        $photoId = $id;

        return $this->redirectToRoute('app_entry', [
            'id' => $photoId,
        ]);
    }
}
