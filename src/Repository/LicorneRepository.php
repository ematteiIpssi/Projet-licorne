<?php

namespace App\Repository;

use App\Entity\Licorne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Licorne>
 *
 * @method Licorne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Licorne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Licorne[]    findAll()
 * @method Licorne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LicorneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Licorne::class);
    }

//    /**
//     * @return Licorne[] Returns an array of Licorne objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Licorne
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
