<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\Filesystem;
use Psr\Log\LoggerInterface;
use Symfony\Component\Asset\Context\RequestStackContext;
use League\Flysystem\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
//    const PATH_SUFFIX = 'images/atlas';
    const PATH_SUFFIX = '';
    const PHOTO = 'fossil-diatom-website-assets/atlas';
    private $filesystem;
    private RequestStackContext $requestStackContext;
    private LoggerInterface $logger;

    private $publicAssetBaseUrl;

    public function __construct(Filesystem $publicUploadFilesystem, RequestStackContext $requestStackContext, LoggerInterface $logger, string $uploadedAssetsBaseUrl)
    {
        $this->filesystem = $publicUploadFilesystem;
        $this->requestStackContext = $requestStackContext;
        $this->logger = $logger;
        $this->publicAssetBaseUrl = $uploadedAssetsBaseUrl;
    }
    public function uploadImage(File $file, ?string $existingFilename): string
    {
        if ($file instanceof UploadedFile)
        {
            $originalFilename = $file->getClientOriginalName();
        }
        else
        {
            $originalFilename = $file->getFilename();
        }

        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $file->guessExtension();

        $stream = fopen($file->getPathname(), 'r');
        $result = $this->filesystem->writeStream(
            self::PHOTO . '/' . $newFilename,
            $stream
        );

        if ($result === false)
        {
            throw new \Exception(sprintf('Could not write uploaded file: %s', $newFilename));
        }

        if (is_resource($stream))
        {
            fclose($stream);
        }

        if ($existingFilename)
        {
            try
            {
                $result = $this->filesystem->delete(self::PHOTO . '/' . $existingFilename);

                if ($result === false)
                {
                    throw new \Exception(sprintf('Could not remove old uploaded file: "%s"', $existingFilename));
                }
            }
            catch (FileNotFoundException $e)
            {
                $this->logger->alert(sprintf('Old uploaded file: "%s" was missing when trying to remove.', $existingFilename));
            }
        }

        return $newFilename;
    }

    public function getPublicPath(string $path): string
    {
        $fullPath = $this->publicAssetBaseUrl . '/' . $path;

        if (strpos($fullPath, '://') !== false)
        {
            return $fullPath;
        }

        return $this->requestStackContext
            ->getBasePath() . $fullPath;
    }
}