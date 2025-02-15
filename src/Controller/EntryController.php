<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EntryController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function updateTimesViewed(Photo $photo, EntityManagerInterface $em)
    {
        $photo->incrementTimesViewed();
        $em->flush();
    }

    #[Route('/atlas/entry/{id<\d+>}', name: 'app_entry', methods: 'GET')]
    public function index(int $id, PhotoRepository $repository): Response
    {
        $photo = $repository->findPhotoById($id);

        if (!$photo) {
            throw $this->createNotFoundException('Photo not found');
        }

        $year = date('Y');
        $url = 'https://fossil-diatoms.com/atlas/entry/' . $id;

        $this->updateTimesViewed($photo, $this->em);

        return $this->render('entry/index.html.twig', [
            'controller_name' => 'EntryController',
            'year' => $year,
            'photo' => $photo,
            'url' => $url
        ]);
    }
}
