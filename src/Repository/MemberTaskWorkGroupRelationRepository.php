<?php

namespace App\Repository;

use App\Entity\MemberTaskWorkGroupRelation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MemberTaskWorkGroupRelation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberTaskWorkGroupRelation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberTaskWorkGroupRelation[]    findAll()
 * @method MemberTaskWorkGroupRelation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberTaskWorkGroupRelationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MemberTaskWorkGroupRelation::class);
    }

    // /**
    //  * @return MemberTaskWorkGroupRelation[] Returns an array of MemberTaskWorkGroupRelation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MemberTaskWorkGroupRelation
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
