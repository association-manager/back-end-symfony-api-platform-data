<?php

namespace App\Repository;

use App\Entity\AssociationProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssociationProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationProfile[]    findAll()
 * @method AssociationProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssociationProfile::class);
    }

    // /**
    //  * @return AssociationProfile[] Returns an array of AssociationProfile objects
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
    public function findOneBySomeField($value): ?AssociationProfile
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
