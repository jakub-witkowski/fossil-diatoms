<?php
namespace App\Controller;
use App\Form\TaxonFormType;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaxonSearchController extends AbstractController
{
    #[Route('/atlas/search-taxon', name: 'app_search_taxon')]
    public function new(PhotoRepository $photoRepository, Request $request): Response
    {
        $form = $this->createForm(TaxonFormType::class);
        $year = date('Y');
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $queryBuilder = $photoRepository->findPhotosByGenusAndSpecies($data['genus'], $data['species']);
            $numberOfResults = count($queryBuilder->getQuery()->getResult());
            $adapter = new QueryAdapter($queryBuilder);
            $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
                $adapter,
                $request->query->get('page', 1),
                9
            );

            return $this->render('search_results/index.html.twig', [
                'controller_name' => 'SearchResultController',
                'year' => $year,
                'numberOfResults' => $numberOfResults,
                'pager' => $pagerfanta,
            ]);
        }

        return $this->render('search_taxon/index.html.twig', [
            'taxonForm' => $form->createView(),
            'year'=>$year
        ]);
    }
}