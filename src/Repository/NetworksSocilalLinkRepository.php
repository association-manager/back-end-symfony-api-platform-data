<?php

namespace App\Repository;

use App\Entity\NetworksSocilalLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NetwortSocilalLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method NetwortSocilalLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method NetwortSocilalLink[]    findAll()
 * @method NetwortSocilalLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NetwortSocilalLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NetwortSocilalLink::class);
    }

    // /**
    //  * @return NetwortSocilalLink[] Returns an array of NetwortSocilalLink objects
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
    public function findOneBySomeField($value): ?NetwortSocilalLink
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
