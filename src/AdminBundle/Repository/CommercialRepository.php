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

    // ---- Suppression un ou plusieurs commercial(commerciaux) selectionné(s)
    public function resetHierarchy($listCom)
    {
        return $this->createQueryBuilder('c')
            ->update()
            ->set('c.hierarchy', 'null')
            ->where('c.hierarchy IN (:listCom)')
            ->setParameter('listCom', array_values($listCom))
            ->getQuery()
            ->execute()
        ;
    }

    public function activeArchive($listCom)
    {
        return $this->createQueryBuilder('c')
            ->update()
            ->set('c.archived', 'true')
            ->where('c.id IN (:listCom)')
            ->setParameter('listCom', array_values($listCom))
            ->getQuery()
            ->execute()
        ;
    }

    // Liste les responsables N+1 lorsque c'est le directeur qui est connécté
    public function listHierarchyDirAndResp($director, $responsable)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.roles LIKE :director')
            ->orWhere('c.roles LIKE :responsable')
            ->andWhere('c.archived = false')
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
            ->andWhere('c.archived = false')
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
        $query = $this->createQueryBuilder('c')
        ->andwhere('c.hierarchy = :com')
        ->andWhere('c.archived = false')
        ->setParameter('com', $com);
        $result = $query->getQuery()->getResult();

        return $result;
    }

    // Retourne les codes commercial séléctionné via critères
    public function getCommercialViaCriteria($criteria, $value)
    {
            $query = $this->createQueryBuilder("c")
                ->select("c.commercialCode")
                ->where($criteria .   " = :value")
                ->setParameter('value', $value)
                ->getQuery();

        return $query->getResult();
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
