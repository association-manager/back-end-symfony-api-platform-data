<?php

namespace App\Repository;

use App\Entity\AdManagementNotification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdManagementNotification|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdManagementNotification|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdManagementNotification[]    findAll()
 * @method AdManagementNotification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdManagementNotificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdManagementNotification::class);
    }

    // /**
    //  * @return AdManagementNotification[] Returns an array of AdManagementNotification objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdManagementNotification
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
