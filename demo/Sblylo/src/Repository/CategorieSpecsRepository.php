<?php

namespace App\Repository;

use App\Entity\CategorieSpecs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategorieSpecs|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieSpecs|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieSpecs[]    findAll()
 * @method CategorieSpecs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieSpecsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategorieSpecs::class);
    }

    // /**
    //  * @return CategorieSpecs[] Returns an array of CategorieSpecs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieSpecs
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
