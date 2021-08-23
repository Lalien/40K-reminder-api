<?php

namespace App\Repository;

use App\Entity\UnitAbility;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnitAbility|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnitAbility|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnitAbility[]    findAll()
 * @method UnitAbility[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnitAbilityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnitAbility::class);
    }

    // /**
    //  * @return UnitAbility[] Returns an array of UnitAbility objects
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
    public function findOneBySomeField($value): ?UnitAbility
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
