<?php

namespace App\Repository;

use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

   /**
    * @return Photo[] Returns an array of Photo objects
    */
   public function sortPhotosByGenusAndSpecies(): array
   {
        $qb = $this->createQueryBuilder('photo')
                ->join('photo.taxon', 'taxon')
                ->join('taxon.genus', 'genus')
                ->join('taxon.species', 'species')
                ->addOrderBy('genus.name')
                ->addOrderBy('species.name');

        $query = $qb->getQuery();

        return $query->getResult();
   }
}
