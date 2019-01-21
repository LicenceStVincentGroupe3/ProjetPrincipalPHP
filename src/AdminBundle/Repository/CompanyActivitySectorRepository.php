<?php

namespace App\AdminBundle\Repository;

use App\Entity\CompanyActivitySector;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyActivitySector|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyActivitySector|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyActivitySector[]    findAll()
 * @method CompanyActivitySector[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyActivitySectorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyActivitySector::class);
    }

    // /**
    //  * @return CompanyActivitySector[] Returns an array of CompanyActivitySector objects
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
    public function findOneBySomeField($value): ?CompanyActivitySector
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
