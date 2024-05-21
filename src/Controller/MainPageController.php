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
        $phrase = '/images/main-page-feature-00';
        $randomPicNumber = random_int(1, 8);
        $mainPageFeatureFilename = $phrase . $randomPicNumber . '.jpg';

        return $this->render('main_page/index.html.twig', [
            'controller_name' => 'MainPageController',
            'year' => $year,
            'imagePath' => $mainPageFeatureFilename
        ]);
    }
}
