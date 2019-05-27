<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\AffectedZone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AffectedZone|null find($id, $lockMode = null, $lockVersion = null)
 * @method AffectedZone|null findOneBy(array $criteria, array $orderBy = null)
 * @method AffectedZone[]    findAll()
 * @method AffectedZone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffectedZoneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AffectedZone::class);
    }

    // /**
    //  * @return AffectedZone[] Returns an array of AffectedZone objects
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
    public function findOneBySomeField($value): ?AffectedZone
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
