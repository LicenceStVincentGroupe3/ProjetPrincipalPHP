<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Company::class);
    }

    // Compte toutes les entreprise liées à un commercial passé en paramètre
    public function countCompany($com)
    {
        $query = $this->createQueryBuilder('c');
        $query->select('COUNT(c.id)');
        $query->where('c.idUser = :com')->setParameter('com', $com);
        $result = $query->getQuery()->getSingleResult();

        return $result;
    }

    // Retourne toutes les entreprises d'un commercial séléctioné
    public function listCompanyOfCommercial($com)
    {
        $query = $this->createQueryBuilder('c');
        $query->where('c.idUser = :com')->setParameter('com', $com);
        $result = $query->getQuery()->getResult();

        return $result;
    }

    // /**
    //  * @return Company[] Returns an array of Company objects
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
    public function findOneBySomeField($value): ?Company
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
