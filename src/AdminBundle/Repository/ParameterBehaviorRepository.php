<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\ParameterBehavior;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ParameterBehavior|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParameterBehavior|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParameterBehavior[]    findAll()
 * @method ParameterBehavior[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParameterBehaviorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ParameterBehavior::class);
    }

    // /**
    //  * @return ParameterBehavior[] Returns an array of ParameterBehavior objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParameterBehavior
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
