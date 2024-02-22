<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Question>
 *
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * $questions = $this->findBy(['title' => "%php%'], [], 10, 20);
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    
    /**
     * @return Question[] Returns an array of Question objects
     */
    public function findByTitleFragment($value): array  // $value = 'php'
    {
       return $this->createQueryBuilder('q') // SELECT * FROM question WHERE 1 AND title = :val ORDER BY id ASC LIMIT 10
               // ->addSelect('q.title')
               // ->addSelect('c.comment')
               //  ->from('App\Entity\Question', 'q')
            ->andWhere('q.title = :val')
            ->orderBy('q.id', 'ASC')
            ->innerJoin('q.comments', 'c')
            ->setParameter('val', $value)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Question
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}