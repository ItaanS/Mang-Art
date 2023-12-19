<?php

namespace App\Repository;

use App\Entity\CalqMangArt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CalqMangArt>
 *
 * @method CalqMangArt|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalqMangArt|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalqMangArt[]    findAll()
 * @method CalqMangArt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalqMangArtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CalqMangArt::class);
    }

//    /**
//     * @return CalqMangArt[] Returns an array of CalqMangArt objects
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

//    public function findOneBySomeField($value): ?CalqMangArt
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
