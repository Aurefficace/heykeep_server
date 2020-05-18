<?php

namespace App\Repository;

use App\Entity\Bloc;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bloc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bloc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bloc[]    findAll()
 * @method Bloc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlocRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bloc::class);
    }

    // /**
    //  * @return Bloc[] Returns an array of Bloc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bloc
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findBlocByIdOwner($userId)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.id_owner = :val')
            ->setParameter('val', $userId)
            ->getQuery()
            ->getResult();
        ;
    }
    public function getLastsActivities(User $user) {
        $queryBuilderSpace = $this->createQueryBuilder('s');
        // $queryBuilderSpace
        //     ->join('s.idMember', 'u')
        //     ->where($queryBuilderSpace->expr()->eq('u.id',  $user->getId()))
        //     ->setMaxResults(5)
        //     ->addOrderBy('s.created_date', 'DESC')
        // ;

        return $queryBuilderSpace->getQuery()->getResult();
    }

}
