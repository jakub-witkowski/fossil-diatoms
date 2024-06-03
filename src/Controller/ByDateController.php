<?php

namespace App\Controller;

// use App\Entity\Photo;
use App\Repository\PhotoRepository;
// use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ByDateController extends AbstractController
{
    // private $em;

    // public function __construct(EntityManagerInterface $em)
    // {
    //     $this->em = $em;
    // }
        

    #[Route('/atlas/by-date', name: 'app_by_date', methods: 'GET')]
    public function index(PhotoRepository $photoRepository, Request $request): Response
    {
        // $repository = $this->em->getRepository(Photo::class);
        // $photos = $repository->findBy(['isPublished' => 'true'], [
        //     'id' => 'DESC'
        // ]);

        $queryBuilder = $photoRepository->sortPublishedPhotosByDate();
        $adapter = new QueryAdapter($queryBuilder);
        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page', 1),
            9
        );

        $year = date('Y');

        return $this->render('by_date/index.html.twig', [
            'controller_name' => 'ByDateController',
            'year' => $year,
            'pager' => $pagerfanta,
        ]);
    }
}
