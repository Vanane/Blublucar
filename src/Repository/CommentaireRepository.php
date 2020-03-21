<?php

namespace App\Repository;

use App\Entity\Commentaire;
use App\Entity\Trajet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }


    public function listeUser($usr)
    {
        return $this->createQueryBUilder('c')
            ->where("c.posteur = '$usr'")
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Commentaire[] Returns an array of Commentaire objects
    //  */
    public function commentairesTrajet($id)
    {
        return $this->createQueryBuilder('c')
            ->where("c.trajet_id = $id")
            ->getQuery()
            ->getResult();
    }


    public function getNoteMoyenneUser($id)
    {
        return $this->createQueryBuilder('c')
            ->select("AVG(c.note)")
            ->join("App\Entity\Trajet", "t", "t.id = c.trajet_id")        
            ->where("t.conducteur = '$id'")
            ->groupBy("t.conducteur")
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getCommentairesUser($id)
    {
        return $this->createQueryBuilder('c')
            ->select("c")
            ->join("App\Entity\Trajet", "t", "t.id = c.trajet_id")        
            ->where("t.conducteur = '$id'")
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Commentaire[] Returns an array of Commentaire objects
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
    public function findOneBySomeField($value): ?Commentaire
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
