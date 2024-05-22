<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BackgroundController extends AbstractController
{
    #[Route('/background', name: 'app_background', methods:'GET')]
    public function index(): Response
    {
        $year = date('Y');

        return $this->render('background/index.html.twig', [
            'controller_name' => 'BackgroundController',
            'year' => $year
        ]);
    }
}
