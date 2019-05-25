<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\OperationForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OperationForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationForm[]    findAll()
 * @method OperationForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationFormRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OperationForm::class);
    }

    // /**
    //  * @return OperationForm[] Returns an array of OperationForm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OperationForm
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
