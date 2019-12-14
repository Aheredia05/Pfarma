<?php

namespace App\Repository;

use App\Entity\Detallefactura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Detallefactura|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detallefactura|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detallefactura[]    findAll()
 * @method Detallefactura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetallefacturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detallefactura::class);
    }

    // /**
    //  * @return Detallefactura[] Returns an array of Detallefactura objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Detallefactura
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
