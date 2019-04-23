<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\Commercial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Commercial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commercial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commercial[]    findAll()
 * @method Commercial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommercialRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Commercial::class);
    }

    // Suppression un ou plusieurs commercial(commerciaux) selectionné(s)
    public function deleteCommercial($listCom)
    {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder();
        $query->delete(Commercial::class, 'c');
        $query->where('c.id IN (:listCom)')->setParameter('listCom', array_values($listCom));
        $rowDeleted = $query->getQuery()->execute();

        return $rowDeleted;
    }

    // Liste les responsables N+1 lorsque c'est le directeur qui est connécté
    public function listHierarchyCom($director, $responsable)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.roles LIKE :director')
            ->andWhere('c.roles LIKE :responsable')
            ->setParameter('director', '%'.$director.'%')
            ->setParameter('responsable', '%'.$responsable.'%')
            ->orderBy('c.commercialProfil', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // Liste les responsables N+1 lorsque c'est un responsable commercial qui est connécté
    public function listHierarchyResp($responsable)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.roles LIKE :responsable')
            ->setParameter('responsable', '%'.$responsable.'%')
            ->orderBy('c.commercialProfil', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Commercial[] Returns an array of Commercial objects
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
    public function findOneBySomeField($value): ?Commercial
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
