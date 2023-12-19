<?php

namespace App\Repository;

use App\Entity\MangArt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MangArt>
 *
 * @method MangArt|null find($id, $lockMode = null, $lockVersion = null)
 * @method MangArt|null findOneBy(array $criteria, array $orderBy = null)
 * @method MangArt[]    findAll()
 * @method MangArt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MangArtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MangArt::class);
    }

//    /**
//     * @return MangArt[] Returns an array of MangArt objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MangArt
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
