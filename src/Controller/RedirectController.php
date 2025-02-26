<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RedirectController extends AbstractController
{
    #[Route('/atlas', name: 'app_redirect', methods: 'GET')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_atlas_homepage');
    }
}
