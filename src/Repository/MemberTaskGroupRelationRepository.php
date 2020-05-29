<?php

namespace App\Repository;

use App\Entity\MemberTaskGroupRelation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MemberTaskGroupRelation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberTaskGroupRelation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberTaskGroupRelation[]    findAll()
 * @method MemberTaskGroupRelation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberTaskGroupRelationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MemberTaskGroupRelation::class);
    }

    // /**
    //  * @return MemberTaskGroupRelation[] Returns an array of MemberTaskGroupRelation objects
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
    public function findOneBySomeField($value): ?MemberTaskGroupRelation
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
