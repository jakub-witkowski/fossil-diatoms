<?php

namespace App\Repository;

use App\Entity\DregdedSite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DregdedSite>
 */
class DregdedSiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DregdedSite::class);
    }

    //    /**
    //     * @return DregdedSite[] Returns an array of DregdedSite objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DregdedSite
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
