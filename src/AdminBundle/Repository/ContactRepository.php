<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    // Compte tous les contacts liés à un commercial passé en paramètre
    public function countContact($com)
    {
        $query = $this->createQueryBuilder('c');
        $query->select('COUNT(c.id)');
        $query->where('c.idUser = :com')->setParameter('com', $com);
        $result = $query->getQuery()->getSingleResult();

        return $result;
    }

    // Retourne tous les contacts d'un commercial séléctioné
    public function listContactOfCommercial($com)
    {
        $query = $this->createQueryBuilder('c');
        $query->where('c.idUser = :com')->setParameter('com', $com);
        $result = $query->getQuery()->getResult();

        return $result;
    }

    public function listContactOfCompany($com)
    {
        $query = $this->createQueryBuilder('c');
        $query->where('c.idCompany = :com')->setParameter('com', $com);
        $result = $query->getQuery()->getResult();

        return $result;
    }

    public function countContactOfCompany($com)
    {
        $query = $this->createQueryBuilder('c');
        $query->select('COUNT(c.id)');
        $query->where('c.idCompany = :com')->setParameter('com', $com);
        $result = $query->getQuery()->getSingleResult();

        return $result;
    }

    public function deleteContact($listCont)
    {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder();
        $query->delete(Contact::class, 'c');
        $query->where('c.id IN (:lesContacts)')->setParameter('lesContacts', array_values($listCont));
        $rowDeleted = $query->getQuery()->execute();

        return $rowDeleted;
    }

    // ---- Suppression un ou plusieurs commercial(commerciaux) selectionné(s)
    public function resetContacts($listCom)
    {
        return $this->createQueryBuilder('c')
            ->update()
            ->set('c.idUser', 'null')
            ->where('c.idUser IN (:listCom)')
            ->setParameter('listCom', array_values($listCom))
            ->getQuery()
            ->execute()
        ;
    }

    // /**
    //  * @return Contact[] Returns an array of Contact objects
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
    public function findOneBySomeField($value): ?Contact
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
