<?php

namespace App\Repository;

use App\Entity\ThemArt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ThemArt>
 *
 * @method ThemArt|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThemArt|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThemArt[]    findAll()
 * @method ThemArt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemArtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThemArt::class);
    }

//    /**
//     * @return ThemArt[] Returns an array of ThemArt objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ThemArt
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
