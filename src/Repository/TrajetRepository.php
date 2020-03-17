<?php

namespace App\Repository;

use App\Entity\Trajet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Trajet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trajet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trajet[]    findAll()
 * @method Trajet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Trajet[]    list()
 */

class TrajetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trajet::class);
    }

    /**
     * @return Trajet[] Returns an array of Trajet objects
    */    
    public function list()
    {
        return $this->createQueryBuilder('t')            
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Trajet[] Returns an array of Trajet objects
    */    
    public function getDerniersTrajets()
    {
        $datetime = new \DateTime(date('c'));
        $dateAjd = $datetime->format('c');
        return $this->createQueryBuilder('t')
        ->where("t.date > '$dateAjd'")
        ->setMaxResults(5)
        ->getQuery()
        ->getResult();
    }

    /**
     * @return Trajet Returns a Trajet object
    */    
    public function getTrajetparSonId($id)
    {
        return $this->createQueryBuilder('t')
        ->where("t.id = '$id'")
        ->getQuery()
        ->getSingleResult();

    }


    // /**
    //  * @return Trajet[] Returns an array of Trajet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    /*
    public function findOneBySomeField($value): ?Trajet
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
