<?php

namespace App\Repository;

use App\Entity\Posts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Posts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Posts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Posts[]    findAll()
 * @method Posts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Posts::class);
    }

    // /**
    //  * @return Posts[] Returns an array of Posts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Posts
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByLikeCount($limit=10,$asArray=false){
        $subqb = $this->createQueryBuilder('p');

           return $subqb->select('p')
                  ->orderBy('p.likecount', 'DESC')
                  ->getQuery()
                    ->setMaxResults($limit)
                    ->getResult();


    }
    public function findPostsofuser($id){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery("SELECT p FROM APP\Entity\Posts p JOIN p.user u WHERE u.userid=:id")
                                ->setParameter('id',$id);
        return $query->getResult();


    }
    public function findPhotoOfUser($name){
       $conn = $this->getEntityManager()->getConnection();
       $sql= 'SELECT photo FROM `comments` JOIN user where comments.commentAuthor=user.name AND user.name=:name LIMIT 1';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $name]);
        return $stmt->executeStatement();
    }

}
