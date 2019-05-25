<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\OperationSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OperationSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationSettings[]    findAll()
 * @method OperationSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationSettingsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OperationSettings::class);
    }

    // /**
    //  * @return OperationSettings[] Returns an array of OperationSettings objects
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
    public function findOneBySomeField($value): ?OperationSettings
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
