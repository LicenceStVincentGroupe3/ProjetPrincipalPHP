<?php

namespace App\Repository;

use App\Entity\ParameterGraphicStyle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ParameterGraphicStyle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParameterGraphicStyle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParameterGraphicStyle[]    findAll()
 * @method ParameterGraphicStyle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParameterGraphicStyleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ParameterGraphicStyle::class);
    }

    // /**
    //  * @return ParameterGraphicStyle[] Returns an array of ParameterGraphicStyle objects
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
    public function findOneBySomeField($value): ?ParameterGraphicStyle
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
