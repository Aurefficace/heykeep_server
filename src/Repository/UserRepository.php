<?php

namespace App\Repository;

use App\Entity\Discussion;
use App\Entity\Space;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findLikeName($name): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.name = :val') // TODO Mat : like à la place
            ->setParameter('val', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    public function getLastsActivities($user) {
        $queryBuilderSpace = $this->getEntityManager()->getRepository(Space::class)->createQueryBuilder('s');
        // Requête pour récupérer les 5 derniers espaces créés   (puis vous améliorerez en récupérant les 5 derniers créés ou modifiés)
        // Penser au orderBy
        // Penser aussi à filtrer les espaces en fonction de ceux que l'utilisateur a le droit de voir

        dump($queryBuilderSpace->getQuery()->getResult());


        $queryBuilderDiscussion = $this->getEntityManager()->getRepository(Discussion::class)->createQueryBuilder('d');
        // Requête pour récupérer les 5 derniers espaces créés   (puis vous améliorerez en récupérant les 5 derniers créés ou modifiés)
        // Penser aux mêmes contraintes que pour space mais ajouter en plus de remonter les discusion où des messages ont été ajoutés


        dump($queryBuilderDiscussion->getQuery()->getResult());
        exit();

        // Lien utile : https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/query-builder.html#working-with-querybuilder

    }


}
