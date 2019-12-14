<?php

namespace App\Repository;

use App\Entity\Detalleproduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Detalleproduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detalleproduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detalleproduct[]    findAll()
 * @method Detalleproduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetalleproductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detalleproduct::class);
    }

    // /**
    //  * @return Detalleproduct[] Returns an array of Detalleproduct objects
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
    public function findOneBySomeField($value): ?Detalleproduct
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
