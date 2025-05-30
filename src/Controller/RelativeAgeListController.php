<?php

namespace App\Controller;

use App\Form\SelectAgeFormType;
use App\Repository\RelativeAgeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RelativeAgeListController extends AbstractController
{
    #[Route('/relative-age-list', name: 'app_relative_age_list', methods: 'GET')]
    public function index(RelativeAgeRepository $relativeAgeRepository): Response
    {
        $form = $this->createForm(SelectAgeFormType::class);
        $year = date('Y');

        return $this->render('relative_age_list/index.html.twig', [
            'controller_name' => 'RelativeAgeListController',
            'selectAge' => $form->createView(),
            'year' => $year,
        ]);
    }
}
