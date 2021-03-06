<?php

namespace App\Repository;

use App\Entity\QOptions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QOptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method QOptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method QOptions[]    findAll()
 * @method QOptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QOptionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QOptions::class);
    }

    // /**
    //  * @return QOptions[] Returns an array of QOptions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QOptions
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
