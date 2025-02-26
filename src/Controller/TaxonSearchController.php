<?php
namespace App\Controller;

use App\Entity\SearchResult;
use App\Form\SearchResultFormType;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaxonSearchController extends AbstractController
{
    #[Route('/search-taxon', name: 'app_search_taxon')]
    public function new(PhotoRepository $photoRepository, Request $request): Response
    {
        $form = $this->createForm(SearchResultFormType::class);
        $year = date('Y');
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $queryBuilder = $photoRepository->findPhotosByGenusAndSpecies($data->getGenus(), $data->getSpecies());
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
                'genus' => $data->getGenus(),
                'species' => $data->getSpecies(),
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