<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    const PATH_SUFFIX = 'images/atlas';
    private $uploadDir;

    public function __construct(string $uploadDir)
    {

        $this->uploadDir = $uploadDir;
    }
    public function uploadImage(UploadedFile $uploadedFile): string
    {
        $destination = $this->uploadDir . '/' . self::PATH_SUFFIX;

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename);

        return $newFilename;
    }

    public function getPublicPath(string $path): string
    {
        return 'assets/' . $path;
    }
}