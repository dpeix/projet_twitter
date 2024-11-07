<?php

namespace App\Repository;

use App\Entity\Conv;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Conv>
 */
class ConvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conv::class);
    }

    public function findByUser(User $user)
    {
        return $this->createQueryBuilder('c')
            ->innerJoin('c.convUsers', 'cu')
            ->where('cu.users = :user')
            ->setParameter('user', $user)
            ->orderBy('c.date_last_message', 'DESC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Conv[] Returns an array of Conv objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Conv
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
