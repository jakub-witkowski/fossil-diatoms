<?php

namespace App\Repository;

use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Photo>
 */
class PhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Photo::class);
    }

    public function sortPublishedPhotosByDate() : QueryBuilder
    {
        $qb = $this->createQueryBuilder('photo')
            ->andWhere('photo.isPublished = 1')
            ->addOrderBy('photo.id', 'DESC');

        return $qb;
    }

    public function sortPublishedPhotosByPopularity(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('photo')
            ->andWhere('photo.isPublished = 1')
            ->addOrderBy('photo.timesViewed', 'DESC');
            
        return $qb;
    }

    public function sortPhotosByGenusAndSpecies(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('photo')
                    ->andWhere('photo.isPublished = 1')
                    ->join('photo.taxon', 'taxon')
                    ->join('taxon.genus', 'genus')
                    ->join('taxon.species', 'species')
                    ->addOrderBy('genus.name')
                    ->addOrderBy('species.name');

        return $qb;
    }

   /**
    * @return Photo 
    */
    public function findPhotoById(int $id): ?Photo
    {
        foreach ($this->findAll() as $photo) {
            if ($photo->getId() === $id) {
                return $photo;
            }
        }
        return null;
    }
}
