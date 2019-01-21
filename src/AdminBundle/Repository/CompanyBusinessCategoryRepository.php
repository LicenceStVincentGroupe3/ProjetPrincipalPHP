<?php

namespace App\AdminBundle\Repository;

use App\Entity\CompanyBusinessCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyBusinessCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyBusinessCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyBusinessCategory[]    findAll()
 * @method CompanyBusinessCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyBusinessCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyBusinessCategory::class);
    }

    // /**
    //  * @return CompanyBusinessCategory[] Returns an array of CompanyBusinessCategory objects
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
    public function findOneBySomeField($value): ?CompanyBusinessCategory
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
