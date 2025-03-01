<?php

namespace App\Controller;

use App\Form\SelectGenusFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaxaListController extends AbstractController
{
    #[Route('/taxa-list', name: 'app_taxa_list')]
    public function new(): Response
    {
        $form = $this->createForm(SelectGenusFormType::class);
        $year = date('Y');
        
        return $this->render('taxa_list/index.html.twig', [
            'selectGenus' => $form->createView(),
            'year'=>$year
        ]);
    }
}
