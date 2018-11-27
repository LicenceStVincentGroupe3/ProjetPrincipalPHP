<?php

namespace App\Repository;

use App\Entity\CompanyNbEmployee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyNbEmployee|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyNbEmployee|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyNbEmployee[]    findAll()
 * @method CompanyNbEmployee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyNbEmployeeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyNbEmployee::class);
    }

    // /**
    //  * @return CompanyNbEmployee[] Returns an array of CompanyNbEmployee objects
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
    public function findOneBySomeField($value): ?CompanyNbEmployee
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
