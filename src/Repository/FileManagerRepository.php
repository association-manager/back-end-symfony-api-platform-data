<?php

namespace App\Repository;

use App\Entity\FileManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FileManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method FileManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method FileManager[]    findAll()
 * @method FileManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileManagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileManager::class);
    }

    // /**
    //  * @return FileManager[] Returns an array of FileManager objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FileManager
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
