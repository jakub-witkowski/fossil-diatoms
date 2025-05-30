<?php

namespace App\Controller;

//use App\Form\SelectGenusFormType;
//use App\Repository\SiteRepository;
use App\Form\SelectSiteFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SiteListController extends AbstractController
{
    #[Route('/site-list', name: 'app_site_list', methods: ['GET'])]
    public function index(): Response
    {
        $form = $this->createForm(SelectSiteFormType::class);
        $year = date('Y');

        return $this->render('site_list/index.html.twig', [
            'controller_name' => 'SiteListController',
            'selectSite' => $form->createView(),
            'year' => $year,
        ]);
    }
}
