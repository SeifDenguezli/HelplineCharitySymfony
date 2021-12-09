<?php

namespace App\Repository;

use App\Entity\EventComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EventComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventComment[]    findAll()
 * @method EventComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventComment::class);
    }

    public function findAllCommentsByEvent($id)
    {
        return $this->createQueryBuilder('ec')
            ->where('ec.event=:id')
            ->setParameter('id',$id)
            ->orderBy('ec.createdAt', 'DESC')
            ->setMaxResults(6)
            ->getQuery()->getResult();
    }

    public function findAvgCommentRatingByEvent($id){
        $test =  $this->createQueryBuilder('ec')
            ->select('AVG(ec.rating) as avgRating')
            ->where('ec.event=:id')
            ->setParameter('id',$id)
            ->getQuery()->getResult();
        return $test[0];

    }

    public function testimonialComments(){
        return $this->createQueryBuilder('ec')
            ->orderBy('ec.createdAt', 'DESC')
            ->setMaxResults(6)
            ->getQuery()->getResult();
    }

    // /**
    //  * @return EventComment[] Returns an array of EventComment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventComment
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
