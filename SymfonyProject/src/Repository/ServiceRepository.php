<?php

namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Service|null find($id, $lockMode = null, $lockVersion = null)
 * @method Service|null findOneBy(array $criteria, array $orderBy = null)
 * @method Service[]    findAll()
 * @method Service[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
    }

    // /**
    //  * @return Service[] Returns an array of Service objects
    //  */

    public function findByExampleField($criteria)
    {
        return $this->createQueryBuilder('e')
           /* ->setParameter('e.TypeService',$criteria['TypeService'])
            ->where('e.TypeService= :TypeService')*/
            ->setParameter('lieu',$criteria['lieu'])
            ->andWhere('e.lieu = :lieu')

           /* ->setParameter('e.DateDisponibilite',$criteria['DateDisponibilite'])
            ->andWhere('e.DateDisponibilite = :DateDisponibilite')*/

           /* ->setParameter('e.description',$criteria['description'])
            ->andWhere('e.description =:description')*/

            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Service
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
