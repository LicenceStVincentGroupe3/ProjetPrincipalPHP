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
    public function listHierarchyDirAndResp($director, $responsable)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.roles LIKE :director')
            ->orWhere('c.roles LIKE :responsable')
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

    // Récupère le responsable N+1 du commercial séléctionné
    public function hierarchyN1($idCom)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :idCom')
            ->setParameter('idCom', $idCom)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // Retourne toutes les commerciaux qui sont rattachés à l'utilisateur connecté
    public function listCommercialsOfUser($com)
    {
        $query = $this->createQueryBuilder('c');
        $query->where('c.hierarchy = :com')->setParameter('com', $com);
        $result = $query->getQuery()->getResult();

        return $result;
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
