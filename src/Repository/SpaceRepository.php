<?php

namespace App\Repository;

use App\Entity\Space;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Space|null find($id, $lockMode = null, $lockVersion = null)
 * @method Space|null findOneBy(array $criteria, array $orderBy = null)
 * @method Space[]    findAll()
 * @method Space[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Space::class);
    }

    // /**
    //  * @return Space[] Returns an array of Space objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Space
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findSpaceByIdOwner($userId)
    {
        return $this->createQueryBuilder('d')
//            ->leftJoin('d.id_user', 'iduser')
            ->where('d.id_owner = :val')
            ->setParameter('val', $userId)
            ->getQuery()
            ->getResult();
    }

    public function getMemberNotOwner($user)
    {
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder
            ->Join('s.idMember', 'u')
            ->where($queryBuilder->expr()->neq('s.id_owner', $user->getId()))
            ->andWhere($queryBuilder->expr()->eq('u.id', $user->getId()))
        ;
        return $queryBuilder ->getQuery()
            ->getResult()
            ;
    }

    public function getLastsActivities(User $user) {
        $queryBuilderSpace = $this->createQueryBuilder('s');
        $queryBuilderSpace
            ->join('s.idMember', 'u')
            ->where($queryBuilderSpace->expr()->eq('u.id',  $user->getId()))
            ->setMaxResults(5)
            ->addOrderBy('s.created_date', 'DESC')
        ;

        return $queryBuilderSpace->getQuery()->getResult();
    }
}
