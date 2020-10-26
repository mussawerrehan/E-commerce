<?php

namespace App\Repository;

use App\Entity\Specs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Specs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Specs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Specs[]    findAll()
 * @method Specs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecsRepository extends ServiceEntityRepository
{
    public function __construct(\Doctrine\Common\Persistence\ManagerRegistry $registry)
    {
        parent::__construct($registry, Specs::class);
    }

    // /**
    //  * @return Specs[] Returns an array of Specs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Specs
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
