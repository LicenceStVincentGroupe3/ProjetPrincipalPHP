<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\OperationSettings;
use App\AdminBundle\Entity\OperationForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Operations::class);
    }

    // Suppression une ou plusieurs opération(s) selectionnée(s)
    public function activeArchive($listOP)
    {
        return $this->createQueryBuilder('o')
            ->update()
            ->set('o.archived', 'true')
            ->where('o.operationCode IN (:listOP)')
            ->setParameter('listOP', array_values($listOP))
            ->getQuery()
            ->execute()
        ;
    }

    // Retourne toutes les opérations d'un commercial
    public function listOperationsOfUser($com)
    {
        $query = $this->createQueryBuilder('o')
        ->where('o.author = :com')
        ->andWhere('o.archived = false')
        ->setParameter('com', $com);
        $result = $query->getQuery()->getResult();

        return $result;
    }

    // ---- Suppression un ou plusieurs commercial(commerciaux) selectionné(s)
    public function resetOperation($listCom)
    {
        return $this->createQueryBuilder('o')
            ->update()
            ->set('o.author', 'null')
            ->set('o.commercialLastUpdate', 'null')
            ->where('o.author IN (:listCom)')
            ->setParameter('listCom', array_values($listCom))
            ->getQuery()
            ->execute()
        ;
    }
}
