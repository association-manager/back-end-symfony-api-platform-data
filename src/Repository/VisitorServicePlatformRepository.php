<?php

namespace App\Repository;

use App\Entity\VisitorServicePlatform;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VisitorServicePlatform|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisitorServicePlatform|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisitorServicePlatform[]    findAll()
 * @method VisitorServicePlatform[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitorServicePlatformRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisitorServicePlatform::class);
    }

    // /**
    //  * @return VisitorServicePlatform[] Returns an array of VisitorServicePlatform objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VisitorServicePlatform
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
