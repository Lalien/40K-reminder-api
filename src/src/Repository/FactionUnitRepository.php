<?php

namespace App\Repository;

use App\Entity\FactionUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FactionUnit|null find($id, $lockMode = null, $lockVersion = null)
 * @method FactionUnit|null findOneBy(array $criteria, array $orderBy = null)
 * @method FactionUnit[]    findAll()
 * @method FactionUnit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactionUnitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FactionUnit::class);
    }

    // /**
    //  * @return FactionUnit[] Returns an array of FactionUnit objects
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
    public function findOneBySomeField($value): ?FactionUnit
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
