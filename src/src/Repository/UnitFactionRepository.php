<?php

namespace App\Repository;

use App\Entity\UnitFaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnitFaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnitFaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnitFaction[]    findAll()
 * @method UnitFaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnitFactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnitFaction::class);
    }

    // /**
    //  * @return UnitFaction[] Returns an array of UnitFaction objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UnitFaction
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
