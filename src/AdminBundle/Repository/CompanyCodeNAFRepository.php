<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\CompanyCodeNAF;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyCodeNAF|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyCodeNAF|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyCodeNAF[]    findAll()
 * @method CompanyCodeNAF[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyCodeNAFRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyCodeNAF::class);
    }

    // /**
    //  * @return CompanyCodeNAF[] Returns an array of CompanyCodeNAF objects
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
    public function findOneBySomeField($value): ?CompanyCodeNAF
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
