<?php

namespace App\Repository;

use App\Entity\People;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<People>
 *
 * @method People|null find($id, $lockMode = null, $lockVersion = null)
 * @method People|null findOneBy(array $criteria, array $orderBy = null)
 * @method People[]    findAll()
 * @method People[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeopleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, People::class);
    }

    public function findPeopleFromClub($clubId): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.clubId = :val')
            ->setParameter('val', $clubId)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function listPlayersByProp(int $clubId, string $property, string $value, int $limit = 20) : array
    {
        $paramProperty = 'p.' .$property ."=";
        $paramPlayer = "player";
        return $this->createQueryBuilder('p')
            ->Where('p.clubId = :id')
            ->setParameter('id', $clubId)
            ->andWhere($paramProperty .':value')
            ->setParameter('value', $value)
            ->andWhere('p.type = :player')
            ->setParameter('player', $paramPlayer)
            ->orderBy('p.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }

    public function listPlayers(int $clubId, int $limit = 20): array
    {
        $param = "player";
        return $this->createQueryBuilder('p')
            ->andWhere('p.clubId = :val')
            ->andWhere('p.type = :player')
            ->setParameter('val', $clubId)
            ->setParameter('player', $param)
            ->orderBy('p.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return People[] Returns an array of People objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?People
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
