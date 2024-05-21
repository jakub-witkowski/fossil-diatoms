<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainPageController extends AbstractController
{
    #[Route('/', name: 'app_main_page', methods: 'GET')]
    public function index(): Response
    {
        $year = date('Y');

        return $this->render('main_page/index.html.twig', [
            'controller_name' => 'MainPageController',
            'year' => $year
        ]);
    }
}
