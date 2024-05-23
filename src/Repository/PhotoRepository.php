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

//    /**
//     * @return Photo[] Returns an array of Photo objects
//     */
   public function sortPhotosByGenusAndSpecies(): array
   {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT 
            photo.id,
            photo.is_published,
            photo.filename,
            photo.description,
            photo.microscope_id,
            photo.sample_id,
            photo.taxon_id,
            photo.technique_id,
            genus.name,
            species.name,
            species.authority,
            species.date_proposed
            FROM photo
            JOIN taxon ON photo.taxon_id = taxon.id
            JOIN genus ON taxon.genus_id = genus.id
            JOIN species ON taxon.species_id = species.id
            ORDER BY genus.name, species.name ASC' 
        );

        return $query->getResult();



    //    return $this->createQueryBuilder('p')
    //        ->andWhere('p.exampleField = :val')
    //        ->setParameter('val', $value)
    //        ->orderBy('p.id', 'ASC')
    //        ->setMaxResults(10)
    //        ->getQuery()
    //        ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Photo
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
