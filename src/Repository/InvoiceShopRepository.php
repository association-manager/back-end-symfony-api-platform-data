<?php

namespace App\Repository;

use App\Entity\InvoiceShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InvoiceShop|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvoiceShop|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvoiceShop[]    findAll()
 * @method InvoiceShop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvoiceShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InvoiceShop::class);
    }

    // /**
    //  * @return InvoiceShop[] Returns an array of InvoiceShop objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InvoiceShop
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
