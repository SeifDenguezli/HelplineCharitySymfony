<?php

namespace App\Repository;

use App\Entity\EventUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EventUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventUser[]    findAll()
 * @method EventUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventUser::class);
    }

    public function findJoinedEventByUser($id)
    {
        return $this->createQueryBuilder('eu')
            ->where('eu.eventId=:id')
            ->setParameter('id',$id)
            ->orderBy('eu.joinDate', 'DESC')
            ->setMaxResults(10)
            ->getQuery()->getResult();
    }

    //Retrouver les participations durant les 30 derniers jours
    public function findLastParticipations()
    {
        $year = (int) date('Y');
        $month = (int) date('m');

        $startDate = new \DateTimeImmutable("$year-$month-01T00:00:00");
        $endDate = $startDate->modify('last day of this month')->setTime(23, 59, 59);

        return $this->createQueryBuilder('eu')
            ->where('eu.joinDate BETWEEN :start AND :end')
            ->setParameter('start', $startDate->format('Y-m-d H:i:s'))
            ->setParameter('end', $endDate->format('Y-m-d H:i:s'))
            ->orderBy('eu.joinDate', 'DESC')
            ->getQuery()->getResult();
    }


    // /**
    //  * @return EventUser[] Returns an array of EventUser objects
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
    public function findOneBySomeField($value): ?EventUser
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
