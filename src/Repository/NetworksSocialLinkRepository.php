<?php

namespace App\Repository;

use App\Entity\NetworksSocialLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NetworksSocialLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method NetworksSocialLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method NetworksSocialLink[]    findAll()
 * @method NetworksSocialLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NetworksSocialLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NetworksSocialLink::class);
    }

    // /**
    //  * @return NetworksSocialLink[] Returns an array of NetworksSocialLink objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NetworksSocialLink
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
