<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use App\Form\PhotoUploadFormType;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class PhotoUploadController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/photo_upload', name: 'app_photo_upload')]
    public function index(Photo $photo, Request $request, EntityManagerInterface $manager, UploaderHelper $uploaderHelper): Response
    {
        $year = date('Y');

        $form = $this->createForm(PhotoUploadFormType::class, $photo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = ($form['imageFile']->getData());

            if ($uploadedFile)
            {
                $newFilename = $uploaderHelper->uploadImage($uploadedFile);
                $photo->setFilename($newFilename);
            }

            $manager->persist($photo);
            $manager->flush();

            $this->addFlash('success', 'Photo was successfully uploaded.');

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin_photo_upload/upload.html.twig', [
            'controller_name' => 'PhotoUploadController',
            'photoUploadForm' => $form->createView(),
            'year' => $year,
        ]);
    }

    public function edit(Photo $photo, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(PhotoUploadFormType::class, $photo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($photo);
            $manager->flush();

            $this->addFlash('success', 'Photo was successfully uploaded.');

            return $this->redirectToRoute('app_photo_upload');
        }

        return $this->render('admin_photo_upload/upload.html.twig', [
            'controller_name' => 'PhotoUploadController',
            'photoUploadForm' => $form->createView(),
        ]);
    }

//    #[Route('/admin/upload/test', name: 'upload_test')]
//    public function temporaryUploadAction(Request $request)
//    {
//        /** @var UploadedFile $uploadedFile */
//        $uploadedFile = $request->files->get('image');
//        $destination = $this->getParameter('kernel.project_dir') . '/public/uploads/';
//
//        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
//        $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();
//
//        dd($uploadedFile->move(
//            $destination,
//            $newFilename
//        ));
//    }
}

