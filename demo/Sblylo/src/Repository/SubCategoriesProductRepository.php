<?php

namespace App\Repository;

use App\Entity\SubCategoriesProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SubCategoriesProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubCategoriesProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubCategoriesProduct[]    findAll()
 * @method SubCategoriesProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubCategoriesProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SubCategoriesProduct::class);
    }

    // /**
    //  * @return SubCategoriesProduct[] Returns an array of SubCategoriesProduct objects
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
    public function findOneBySomeField($value): ?SubCategoriesProduct
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
