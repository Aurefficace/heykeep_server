<?php

namespace App\Repository;

use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function getLastsActivities(User $user) {
//        $em = $this->getEntityManager();
//
//        $conn = $em->getConnection();
//        $sql = "
//                SELECT * FROM message
//                WHERE message.id IN (
//                    SELECT MAX(m.id) from message m
//                        INNER JOIN discussion d ON d.id = m.id_discussion_id
//                        INNER JOIN discussion_user du ON du.discussion_id = d.id AND du.user_id = ?
//                        group by m.id_discussion_id
//                    )
//                ORDER BY message.created_date DESC
//                LIMIT 5
//                ;"
//        ;
//        $stmt = $conn->prepare($sql);
//        $stmt->bindValue(1, $user->getId());
//        $stmt->execute();
//
//        dump($stmt->fetchAll());
//        exit();

        $queryBuilderDiscussion = $this->createQueryBuilder('m');
        $queryBuilderDiscussion
            ->andWhere($queryBuilderDiscussion->expr()->in('m.id',
                $this->getEntityManager()->getRepository(Message::class)->createQueryBuilder('m2')
                    ->select('MAX(m2.id)')
                    ->join('m2.id_discussion', 'd')
                    ->join('d.id_user', 'u')
                    ->where($queryBuilderDiscussion->expr()->eq('u.id',  $user->getId()))
                    ->addGroupBy('m2.id_discussion')
                    ->getDQL()
            ))
            ->setMaxResults(5)
            ->addOrderBy('m.created_date', 'DESC')
        ;

//        dump($queryBuilderDiscussion->getQuery()->getResult());
//        exit();
        return $queryBuilderDiscussion->getQuery()->getResult();
    }
}
