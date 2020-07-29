<?php

namespace App\Repository;

use App\Entity\AssoManagerEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssoManagerEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssoManagerEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssoManagerEvent[]    findAll()
 * @method AssoManagerEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssoManagerEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssoManagerEvent::class);
    }

    // /**
    //  * @return AssoManagerEvent[] Returns an array of AssoManagerEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AssoManagerEvent
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
