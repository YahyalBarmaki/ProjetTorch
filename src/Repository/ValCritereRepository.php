<?php

namespace App\Repository;

use App\Entity\ValCritere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ValCritere|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValCritere|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValCritere[]    findAll()
 * @method ValCritere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValCritereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ValCritere::class);
    }

    // /**
    //  * @return ValCritere[] Returns an array of ValCritere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ValCritere
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
